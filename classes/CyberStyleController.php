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
            case "add-to-closet":
                $this->add_to_closet();
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
        if (isset($_POST["email"])) {
            $insert = $this->db->query("insert into users (name, email, password) values (?, ?, ?);", 
            "sss", $_POST["name"], $_POST["email"], 
            password_hash($_POST["password"], PASSWORD_DEFAULT));
            if ($insert === false) {
                $error_msg = "Error inserting user";
            } 
            $_SESSION["name"] = $_POST["name"];
            $_SESSION["email"] = $_POST["email"];
            header("Location: ?command=wardrobe");
        }

        include('templates/sign-up.html');
    }

    public function login() {
        if (isset($_POST["email"])) {
            $data = $this->db->query("select * from users where email = ?;", "s", $_POST["email"]);
            if ($data === false) {
                $error_msg = "Error checking for user";
            } else if (!empty($data)) {
                if (password_verify($_POST["password"], $data[0]["password"])) {
                    $_SESSION['name'] = $data[0]["name"];
                    $_SESSION['email'] = $data[0]["email"];
                    setcookie("logged_in", true, time() + 3600);
                    header("Location: ?command=wardrobe");
                } else {
                    $error_msg = "Wrong password";
                }
            }
        }
        include('templates/login.php');
    }

    public function add_to_closet() {
        include('templates/add-to-closet.php');
    }

    public function wardrobe() {
        include('templates/wardrobe.php');
    }

    public function transaction_history() {
        $user_ids = $this->db->query("select id from Users where email = ?;", "s", $_SESSION["email"]);
        $id = $user_ids[0]["id"];
        $user_categories_and_balances = $this->db->query("select category, balance from Users_Balance_By_Category
        where user_id = ?;", "i", $id);
        $all_balance = $this->db->query("select balance from Users_Balance_By_Category where user_id = ?;",
        "i", $id);
        $total_balance = 0;
        foreach($all_balance as $balance) {
            $total_balance += $balance["balance"];
        }
        $transactions = $this->db->query("select name, t_date, amount, type, category from Transactions where user_id = ?;", "i", $id);
        $date = array_column($transactions, 't_date');
        array_multisort($date, SORT_DESC, $transactions);
        include('templates/TransactionHistory.php');
    }

    public function new_transaction() {
        if (isset($_POST["amount"])) {
            if (isset($_POST["type"]) && $_POST["type"] !== "Select the Type of Transaction"
            && isset($_POST["category"]) && $_POST["category"] !== "Select the Category of Transaction") {
                $user_ids = $this->db->query("select id from Users where email = ?;", "s", $_SESSION["email"]);
                $id = $user_ids[0]["id"];
                $user_categories_assoc = $this->db->query("select category from Users_Balance_By_Category
                where user_id = ?;", "i", $id);
                $amount = $_POST["amount"];
                if ($_POST["type"] === "Debit") {
                    $amount = $_POST["amount"]-(2*$_POST["amount"]);
                }
                $user_categories = array();
                foreach($user_categories_assoc as $item) {
                    array_push($user_categories, $item["category"]);
                }
                print_r($user_categories);
                if (!in_array($_POST["category"], $user_categories)) {
                    $this->db->query("insert into Users_Balance_By_Category (user_id, category, balance)
                    values (?, ?, ?);", "isi", $id, $_POST["category"], $amount);
                } else {
                    $this->db->query("update Users_Balance_By_Category set balance = (balance + ?)
                     where user_id = ? and category = ?;", "iis", $amount, $id, $_POST["category"]);
                }
                $insert = $this->db->query("insert into Transactions (user_id, category, t_date, amount, name, type)
                 values (?, ?, ?, ?, ?, ?);", 
                "ississ", $id, $_POST["category"], $_POST["date"], $amount, $_POST["transaction_name"], $_POST["type"]);
                $error_msg = "Select the type and category";
            }
            header("Location: ?command=transaction-history");
        }
        include('templates/NewTransaction.php');
    }

    public function logout() {
        setcookie("logged_in", "", time() - 3600);
        session_destroy();
        header("Location: ?command=home");
    }
}