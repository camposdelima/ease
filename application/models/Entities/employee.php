<?php

namespace Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="funcionarios")
 */
class Employee
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
	 *  @OneToOne(targetEntity="school")
	 *  @JoinColumn(name="id_autoescola", referencedColumnName="id")
	 */
    protected $school;
	
	/**
	 *  @OneToOne(targetEntity="user")
	 *  @JoinColumn(name="id_usuario", referencedColumnName="id")
	 */
    protected $user;
	
    /**
     * @Column(name="nome", type="string", length=50, unique=true, nullable=false)
     */
    protected $name;

	public function IsActive() {
		return $this->active;
	}	
	
	public function ToArray() {
		return array(
		            'id' => $this->id,
		            'active'=> $this->active,
		          	'school'=> $this->school->ToArray(),
		           	'user'=> $this->user->ToArray(),
		            'name' => $this->name
		        );
	}
}