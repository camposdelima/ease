<?php

namespace Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="usuarios")
 */
class User
{

    /**
     * @Id
     * @Column(type="integer", nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Column(name="ativo", type="boolean")
     */
    protected $active;

    /**
     * @Column(name="usuario", type="string", length=30, unique=true, nullable=false)
     */
    protected $username;

    /**
     * @Column(name="senha", type="string", length=30, nullable=false)
     */
    protected $password;

	public function IsActive() {
		return $this->active;
	}
	
	public function SetActive($value) {
		$this->active = $value;
	}
	
	public function SetPassword($value) {
		$this->password = $value;
	}	
	
	public function SetUsername($value) {
		$this->username = $value;
	}
		
	public function ToArray() {
		return array(
		            'id' => $this->id,
		            'active'=> $this->active,
		            'username' => $this->username
		        );
	}
}