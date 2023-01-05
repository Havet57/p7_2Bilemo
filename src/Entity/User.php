<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: UserRepository::class)]
/**
 * @ORM\Entity(repositoryClass="src\Repository\UserRepository")
 * @UniqueEntity("email")
 * @UniqueEntity("name")
 * @ApiResource(
 * 	collectionOperations={},
 * 	itemOperations={
 *     "showAll"={
 * 		   "route_name"="api.users.client.showAll",
 *         "method"="GET",
 *         "path"="/users_client/{id}",
 *         "controller"=ApiUserController::class,
 * 			"swagger_context" = {
 * 				"summary" = "List of registered users linked to a client",
 * 			    "parameters" = {
 *                  {
 *                      "name" = "id",
 *                      "in" = "path",
 *                      "required" = true,
 *                      "type" = "integer",
 * 						"description" = "Id of your client"
 *                  }
 *              },
 *              "consumes" = {
 *                  "application/json",
 *               },
 *              "produces" = {
 *                  "application/json"
 *               }
 * 			}
 *     },
 *     "read"={
 * 		   "route_name"="api.users.read",
 *         "method"="GET",
 *         "path"="/users/{id}",
 * 			"swagger_context" = {
 * 				"summary" = "Detail of a registered user",
 * 			    "parameters" = {
 *                  {
 *                      "name" = "id",
 *                      "in" = "path",
 *                      "required" = true,
 *                      "type" = "integer",
 * 						"description" = "Id of your user"
 *                  }
 *              },
 *              "consumes" = {
 *                  "application/json",
 *               },
 *              "produces" = {
 *                  "application/json"
 *               }
 * 			}
 *     },
 *     "createUser"={
 * 		   "route_name"="api.users.create",
 *         "method"="POST",
 *         "path"="/users_client/{id}",
 * 			"swagger_context" = {
 * 				"summary" = "Add a new user linked to a client",
 * 			    "parameters" = {
 *                  {
 *                      "name" = "id",
 *                      "in" = "path",
 *                      "required" = true,
 *                      "type" = "integer",
 * 						"description" = "Id of your client. The created user will be linked to this client",
 *                  },
 *                  {
 *                      "name" = "user",
 *                      "in" = "body",
 *                      "required" = true,
 *                      "type" = "string",
 * 						"description" = "Data of your new user",
 * 						"schema": {
 * 							"properties": {
 *         						"name": {
 * 									"type": "string",
 * 									"example": "name of user"
 * 								},
 * 								"email": {
 * 									"type": "string",
 * 									"example": "user@user.fr"
 * 								},
 * 								"password": {
 * 									"type": "string",
 * 									"example": "password"
 * 								},
 * 							}
 * 						 }
 *                  }
 *              },
 *              "consumes" = {
 *                  "application/json",
 *               },
 *              "produces" = {
 *                  "application/json"
 *               }
 * 			}
 *     },
 *     "updateUser"={
 * 		   "route_name"="api.users.update",
 *         "method"="PUT",
 *         "path"="/users/{id}",
 * 			"swagger_context" = {
 * 				"summary" = "Update a user",
 * 			    "parameters" = {
 *                  {
 *                      "name" = "id",
 *                      "in" = "path",
 *                      "required" = true,
 *                      "type" = "integer",
 * 						"description" = "Id of your user.",
 *                  },
 *                  {
 *                      "name" = "user",
 *                      "in" = "body",
 *                      "required" = true,
 *                      "type" = "string",
 * 						"description" = "Data of your new user",
 * 						"schema": {
 * 							"properties": {
 *         						"name": {
 * 									"type": "string",
 * 									"example": "name of user"
 * 								},
 * 								"email": {
 * 									"type": "string",
 * 									"example": "user@user.fr"
 * 								},
 * 								"password": {
 * 									"type": "string",
 * 									"example": "password"
 * 								},
 * 							}
 * 						 }
 *                  }
 *              },
 *              "consumes" = {
 *                  "application/json",
 *               },
 *              "produces" = {
 *                  "application/json"
 *               }
 * 			}
 *     },
 *     "deleteUser"={
 * 		   "route_name"="api.users.delete",
 *         "method"="DELETE",
 *         "path"="/users/{id}",
 * 			"swagger_context" = {
 * 				"summary" = "Delete a user linked to a client",
 * 				"parameters": {
 * 					{
 * 						"name": "id",
 * 						"in": "path",
 * 						"required": true,
 * 						"type": "integer",
 * 						"description": "Id of user to delete"
 * 					}
 * 				},
 *              "consumes" = {
 *                  "application/json",
 *               },
 *              "produces" = {
 *                  "application/json"
 *               }
 * 			}
 *     },
 * }
 * )
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'user', cascade:["persist"])]
    #[ORM\JoinColumn(nullable: true)]
    private ?Customer $customer = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }
}
