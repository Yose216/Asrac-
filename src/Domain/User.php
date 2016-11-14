<?php
namespace Asrac\Domain;

use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface {

    private $id;
    private $username;
    private $password;
    private $salt;
    private $role;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getSalt() {
        return $this->salt;
    }

    public function setSalt($salt) {
        $this->salt = $salt;
    }

    public function getRole() {
        return $this->role;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    public function getRoles() {
        return array($this->getRole());
    }

    public function eraseCredentials() {
        // Nothing to do here
    }
}
