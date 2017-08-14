<?php
    //mbv twitter oef
    class User
    {
        private $m_sEmail;
        private $m_sPassword;

        public function __set($p_sProperty, $p_vValue)
        {
            switch ($p_sProperty){
                case "Email":
                    $this->m_sEmail = $p_vValue;
                    break;
                case "Password":
                    $this->m_sPassword = $p_vValue;
                    break;
            }
        }
        public function __get($p_sProperty)
        {
            switch ($p_sProperty) {
                case "Email":
                    return $this->m_sEmail;
                    break;
                case "Password":
                    return $this->m_sPassword;
                    break;
            }
        }
        public function canLogin() {
            try {
                if (!empty($this->m_sEmail) && !empty($this->m_sPassword)) {
                    session_start();
                    $conn = new PDO("mysql:host=localhost; dbname=period", "root", "");
                    $statement = $conn->prepare("select * from users where email = :email");
                    $statement->bindValue(":email", $this->m_sEmail);
                    $statement->execute();
                    $result = $statement->fetch(PDO::FETCH_ASSOC);
                    if (count($result) > 0 && password_verify($this->m_sPassword, $result['password'])) {
                        $_SESSION['id'] = $result['id'];
                        $_SESSION['loggedin'] = true;
                        return true;
                    } else {
                        echo "Deze combinatie bestaat niet.";
                        return false;
                    }

                }
            }
            catch (Exception $e){
                    echo  $e->getMessage();
                }
        }
        public function register() {
            if(!empty($this->m_sEmail) && !empty($this->m_sPassword)){
                try{
                    $conn = new PDO("mysql:host=localhost; dbname=period", "root", "" );
                $statement = $conn->prepare("insert into users (email, password) values (:email, :password)");
                $options = [
                    'cost' => 12
                ];
                $password = password_hash($this->m_sPassword, PASSWORD_DEFAULT, $options);
                $statement->bindValue(":email", $this->m_sEmail);
                $statement->bindValue(":password", $password);
                $statement->execute();
                    $_SESSION['id'];
                    $_SESSION['loggedin']=true;
                    header("Location: index.php");
                }catch (Exception $e){
                    echo  $e->getMessage();
                }
            }
            else {
                echo 'Kan niet connecteren met de databank';
            }
        }
    }