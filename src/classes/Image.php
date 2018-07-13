<?php
class Image
{
    public $database;
    public function __construct()
    {
        $this->database = Database::connect();
    }
    protected function request($sql, $params = [])
    {
        $query = $this->database->prepare($sql);
        $result = $query->execute($params);
        if ($result === false) {
            error_log($query->errorInfo()[2], 3, $_SERVER['DOCUMENT_ROOT'] . Log::ERRORS_LOG);
            return false;
        }
        return $query;
    }

    const PLACEHOLDER = 'https://fakeimg.pl/300x200';
    const THUMBNAIL_PATH = 'pub/media/thumbnails/';
    const IMAGE_PATH = 'pub/media/images/';

    //sorting the images by date
    public function sort(&$images)
    {
        if (!empty($images)) {
            //sorting part
            usort($images, function ($imageA, $imageB) {
                if ($imageA['created_at'] == $imageB['created_at']) {
                    return 0;
                }
                return ($imageA['created_at'] < $imageB['created_at']) ? -1 : 1;
            });
        }
    }
    //time and date formatting
    public function getCurrentDate()
    {
        return date('d M Y H:i:s', time());
    }
    //showing the images
    public function exists($imagePath)
    {
        if (file_exists(self::IMAGE_PATH . $imagePath)) {
            return self::IMAGE_PATH . $imagePath;
        } else {
            return self::PLACEHOLDER;
        }
    }
    //creating the thumbnails
    public function thumbnail($imagePath, &$width, &$height)
    {
        if (!$this->createDir(self::THUMBNAIL_PATH)) {
            return self::PLACEHOLDER;
        }
        $params = $this->getOriginalSize($imagePath);
        $thumbnailPath = $this->resize($imagePath, $width, $height, $params);
        list($width, $height) = $params;
        if ($thumbnailPath) {
            return $thumbnailPath;
        } else {
            return self::PLACEHOLDER;
        }
    }
    //change the images size
    public function resize($imagePath, $width, $height, $params)
    {
        $filename = self::THUMBNAIL_PATH . basename($imagePath);
        if (file_exists($filename)) {
            return $filename;
        }
        $mime = $params['mime'];
        //use specific function based on image format
        switch ($mime) {
            case 'image/jpeg':
                $imageCreateFunc = 'imagecreatefromjpeg';
                $imageSaveFunc = 'imagejpeg';
                break;
            case 'image/png':
                $imageCreateFunc = 'imagecreatefrompng';
                $imageSaveFunc = 'imagepng';
                break;
            case 'image/gif':
                $imageCreateFunc = 'imagecreatefromgif';
                $imageSaveFunc = 'imagegif';
                break;
            default:
                throw new Exception('Sorry, we support only JPEG, PNG and GIF images');
        }
        //Variable function
        $img = $imageCreateFunc($imagePath);
        //list is php construction that allows to set array elements to variables
        list($originalWidth, $originalHeight) = $params;
        //calculate height
        if (!$height) {
            $height = ($originalHeight / $originalWidth) * $width;
        }
        //create new image
        $bufferImage = imagecreatetruecolor($width, $height);
        imagecopyresampled($bufferImage, $img, 0, 0, 0, 0, $width, $height, $originalWidth, $originalHeight);
        //return buffer output as string
        ob_start();
        $imageSaveFunc($bufferImage);
        $imageSource = ob_get_clean();
        if (file_put_contents($filename, $imageSource)) {
            return $filename;
        }
        return false;
    }
    //getting the images size
    public function getOriginalSize($imagePath)
    {
        return getimagesize($imagePath);
    }
    //delete images
    public function delete($id)
    {
        if (App::get('session')->isLoggedIn()) {
            $image = $this->request("SELECT image_path, thumbnail_path FROM images WHERE id = :id", [':id' => $id]);
            $this->request("DELETE FROM images WHERE id = :id", [':id' => $id]);
            unlink($image->fetchColumn(0));
            unlink($image->fetchColumn(1));
            $_SESSION['messages'] = ['You have deleted image'];
            return true;
        } else {
            $_SESSION['errors'] = ['Log in to delete images'];
            return false;
        }
    }
    //save the images
    public function save()
    {
        $sql = 'INSERT INTO images(id, image_path, thumbnail_path, description, author_name, created_at, user_id)
VALUES(NULL, :image_path, :thumbnail_path, :description, :author_name, CURRENT_TIMESTAMP(), :user_id)';
        if ($filename = $this->upload($_FILES['image'])) {
            $width = 300;
            $height = 200;
            $params = [
                ':image_path' => $filename,
                ':thumbnail_path' => $this->thumbnail($filename, $width, $height),
                ':description' => $_REQUEST['description'],
                ':author_name' => $_REQUEST['authorname'],
                ':user_id' => $_SESSION['auth'],
            ];
            $this->request($sql, $params);
            App::get('session')->setMessage('New image was uploaded');
            unset($_SESSION['fields']);
            return true;
        }
        App::get('session')->setError('Unable to upload image');
        return false;
    }
    public function getCollection()
    {
        if (isset($_GET['p'])) {
            $offset = $_GET['p'] - 1;
        } else {
            $offset = 0;
        }
        $offset = $offset * Pagination::IMAGE_COUNT;
        $sql = "SELECT images.id, image_path, thumbnail_path, author_name, description, created_at, login FROM images
        LEFT JOIN users on images.user_id = users.id WHERE images.user_id = :user_id;
        LIMIT " . $offset . ", " . Pagination::IMAGE_COUNT;
        $params = [
            ':user_id' => $_SESSION['auth'],
        ];

        $result = $this->request($sql, $params);
        $images = [];
        if ($result->rowCount() > 0) {
            foreach ($result->fetchAll() as $value) {
                $images[] = $value;
            }
        } else {
            // set empty array
            $images = [];
        }
        $this->sort($images);
        return $images;
    }
    public function upload($file)
    {
        if (!$this->createDir(self::IMAGE_PATH)) {
            return false;
        }
        $filename = self::IMAGE_PATH . time() . $file['name'];
        if (move_uploaded_file($file['tmp_name'], $filename)) {
            return $filename;
        }
        return false;
    }
    public function createDir($path)
    {
        if (!file_exists($path)) {
            return mkdir($path, 0777);
        }
        return true;
    }
}