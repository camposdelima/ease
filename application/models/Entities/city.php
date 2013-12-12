<?php

namespace Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="cidades")
 */
class City
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
     * @Column(name="nome", type="string", length=50, unique=true, nullable=false)
     */
    protected $name;

	public function IsActive() {
		return $this->active;
	}	
	
	public function SetName($value) {
		$this->name = $value;
	}
	
	public function ToArray() {
		return array(
		            'id' => $this->id,
		            'active'=> $this->active,
		            'name' => $this->name
		        );
	}
}