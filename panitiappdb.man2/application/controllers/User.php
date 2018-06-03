<?php
namespace Controllers;

/**
 * User class Controller - Handle user activity such as login, register and logout
 */
class User extends \Core\Controller
{
    public function __construct()
    {
        parent::__construct();

        // Load models
        $this->userModel = $this->model->load('UserModel');
    }

    public function register()
    {
        $data['notif'] = '';

        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $power = 1;
            if ($username === "" AND $password === "") {
                $data['notif'] = "<span class='label label-danger'>Empty username or password</span>";
            } else {
                if ($this->userModel->newUser($username, $password, $power)) {
                    $this->uri->redirect(HOME);
                } else {
                    $data['notif'] = "<span class='label label-danger'>Try another username or password</span>";
                }
            }
        }

        $this->view->load("admin/register", $data);
    }

    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $data['notif'] = '';
            $this->view->load("admin/login", $data);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if (!empty($username) AND !empty($password)) {

                if ($this->userModel->verify($username, $password)) {
                    $sessionRaw = $this->sessionHandler->getSessionFile();

                    if ($this->userModel->updateUserInfo($sessionRaw)) {
                        $this->uri->redirect(HOME);
                    } else {
                        $data['notif'] = "Failed to update session";
                        // $this->uri->redirect(HOME.'/forbidden');
                    }

                } else {
                    $data['notif'] = "Wrong username or password";
                }
            } else {
                $data['notif'] = "Empty username or password";
            }

            $this->view->load("admin/login", $data);
        }
    }

    public function isAdmin()
    {
        if (isset($_SESSION['role'])) {
            if($_SESSION['role'] === 'admin') {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function isPegawai()
    {
        if (isset($_SESSION['role'])) {
            if($_SESSION['role'] === 'pegawai') {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function logout()
    {
        $this->sessionHandler->stop();
        $this->uri->redirect(HOME);
    }
}
