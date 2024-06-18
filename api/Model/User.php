<?php

namespace mmr\todolist\Model;

class User
{
  private int $id;
  private string $username;
  private string $password;
  private string $name;
  private string $email;

  public function __construct(int $id, string $username, string $password, string $name, string $email)
  {
    $this->id = $id;
    $this->username = $username;
    $this->password = $password;
    $this->name = $name;
    $this->email = $email;
  }

  public function getId(): int
  {
    return $this->id;
  }

  public function getUsername(): string
  {
    return $this->username;
  }

  public function setUsername(string $username)
  {
    $this->username = $username;
  }

  public function getPassword(): string
  {
    return $this->password;
  }

  public function setPassword(string $password)
  {
    $this->password = $password;
  }

  public function getName(): string
  {
    return $this->name;
  }

  public function setName(string $name)
  {
    $this->name = $name;
  }

  public function getEmail(): string
  {
    return $this->email;
  }

  public function setEmail(string $email)
  {
    $this->email = $email;
  }
}
