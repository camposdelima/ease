<?php

namespace Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="processos")
 */
class Process
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
     * @Column(name="nome", type="string", length=20, unique=true, nullable=false)
     */
    protected $name;

	public function IsActive() {
		return $this->active;
	}	
	
	public function ToArray() {
		return array(
		            'id' => $this->id,
		            'active'=> $this->active,
		            'name' => $this->name
		        );
	}
}