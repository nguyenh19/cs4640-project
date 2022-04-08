<?php

class CyberStyleController {
    private $command;

    private $db;

    public function __construct($command) {
        $this->command = $command;
        $this->db = new Database();
    }
    
    public function run() {
        switch($this->command) {
            case "sign-up":
                $this->sign_up();
                break;
            case "wardrobe":
                $this->wardrobe();
                break;
            case "view-all-clothes":
                $this->view_all_clothes();
                break;
            case "add-to-closet":
                $this->add_to_closet();
                break;
            case "delete-from-closet":
                $this->delete_from_closet();
                break;
            case "search-clothes":
                $this->search_clothes();
                break;
            case "logout":
                $this->logout();
            case "login":
                $this->login();
                break;
            default:
                $this->home();
                break;
        }
    }

    public function home() {
        include('templates/home.php');
    }

    public function sign_up() {
        $message = "";
        if (isset($_POST["email"])) {
            echo "bye";
            $regex = "/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/";
            if (preg_match($regex, $_POST["email"]) === 1) {
                $user_id = $this->db->query("select id from Users where email = ?;", "s", $_POST["email"]);
                print($user_id);
                if ($user_id === false || empty($user_id)) {
                    $insert = $this->db->query("insert into users (name, email, password) values (?, ?, ?);", 
                    "sss", $_POST["name"], $_POST["email"], 
                    password_hash($_POST["password"], PASSWORD_DEFAULT));
                    if ($insert === false) {
                        $error_msg = "Error inserting user";
                    }
                    setcookie("logged_in", "true", time() + 3600); 
                    $_SESSION["name"] = $_POST["name"];
                    $_SESSION["email"] = $_POST["email"];
                    header("Location: ?command=wardrobe");
                }
                else {
                    $msg = "You already have an account";
                    $_SESSION["login_error_msg"] = $msg;
                    header("Location: ?command=login");
                }
            }
            else {
                $message = "<div class='alert alert-danger' role='alert'> Invalid Input! Please enter the correct email format using an @. </div>";
            }
        }
       
        include('templates/sign-up.php');
    }

    public function login() {
        $message = "";
        if (isset($_POST["email"])) {
            $regex = "/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/";
            if (!preg_match($regex, $_POST["email"])){
                $message = "<div class='alert alert-danger' role='alert'> Invalid Input! Please enter the correct email format using an @. </div>";
            }
            $data = $this->db->query("select * from users where email = ?;", "s", $_POST["email"]);
            if ($data === false) {
                $error_msg = "Error checking for user";
            } else if (!empty($data)) {
                if (password_verify($_POST["password"], $data[0]["password"])) {
                    setcookie("logged_in", "true", time() + 3600);
                    $_SESSION['name'] = $data[0]["name"];
                    $_SESSION['email'] = $data[0]["email"];
                    header("Location: ?command=wardrobe");
                } else {
                    $error_msg = "Wrong password";
                }
            }
        }
        include('templates/login.php');
    }

    public function view_all_clothes() {
        $user = $this->db->query("select id from users where email = ?;", "s", $_SESSION["email"]);
        $array = $this->db->query("select * from clothing where user_id = ?;", "i", $user[0]["id"]);
        $rows = array();
        foreach ($array as $i) {
            $rows[] = $i;
        }
        // if (isset($_POST["search"])) {
        //     $search_tag = $_POST["search"];
        //     $user_id = $this->db->query("select id from Users where email = ?;", "s", $_SESSION["email"]);
        //     $applicable_clothes = $this->db->query("select * from clothing where (user_id = ?) and ((category like ?)
        //     or (brand like ?) or (color like ?) or (name like ?));",
        //     "issss", $user_id, $search_tag, $search_tag, $search_tag, $search_tag);
        //     print_r($applicable_clothes);
        //     $_SESSION["active-search"] = true;
        // }
        include('templates/view-all-clothes.php');
    }

    public function search_clothes() {
        if (isset($_POST["search"])) {
            $search_tag = $_POST["search"];
            $user_id = $this->db->query("select id from users where email = ?;", "s", $_SESSION["email"]);
            $user_id = $user_id[0]["id"];
            $applicable_clothes = $this->db->query("select * from clothing where (user_id = ?) and ((category like ?)
            or (brand like ?) or (color like ?) or (name like ?));",
            "issss", $user_id, $search_tag, $search_tag, $search_tag, $search_tag);
            $_SESSION["active-search"] = true;
        }
        include('templates/view-all-clothes.php');
    }

    public function delete_from_closet() {
        if (isset($_POST['delete_clothes'])) {
            foreach($_POST['delete_clothes'] as $clothing_id) {
                $this->db->query("delete from clothing where clothing_id = ?", "i", $clothing_id);
            }
            header("Location: ?command=view-all-clothes");
        }
        include('templates/delete-from-closet.php');
    }

    public function add_to_closet() {
        if (isset($_POST["name"])) {
            $user_id = $this->db->query("select id from users where email = ?;", "s", $_SESSION["email"]);
            $user_id = $user_id[0]["id"];
            $name = "_" . $user_id . "_" . $_FILES['file']['name'];
            $target_dir = "images/users/";
            $target_file = $target_dir . "_" . $user_id . "_" . basename($_FILES["file"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $extensions_arr = array("jpg","jpeg","png","gif");
            // Check extension
            if( in_array($imageFileType,$extensions_arr) ){
              // Upload file
              if(move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name)){
                 // Convert to base64 
                 $image_base64 = base64_encode(file_get_contents('images/users/'.$name) );
                 $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
              }
            }
            if (isset($_POST["brand"])) {
                $this->db->query("insert into clothing (user_id, category, color, brand, name, picture) 
                values (?, ?, ?, ?, ?, ?);", "isssss", $user_id, $_POST["category"], $_POST["color"],
                $_POST["brand"], $_POST["name"], $name);
                header("Location: ?command=wardrobe");
            } else {
                $this->db->query("insert into clothing (user_id, category, color, name, picture) 
                values (?, ?, ?, ?, ?, ?);", "isssb", $user_id, $_POST["category"], $_POST["color"], 
                $_POST["name"], $name);
                header("Location: ?command=wardrobe");
            }
        }
        include('templates/add-to-closet.php');
    }

    public function wardrobe() {
        include('templates/wardrobe.php');
    }
           

    public function logout() {
        setcookie("logged_in", "", time() - 3600);
        session_destroy();
        header("Location: ?command=home");
    }
}
