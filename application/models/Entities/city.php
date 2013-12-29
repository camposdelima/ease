<?php

namespace Entities;


/**
 * @Entity
 * @Table(name="cidades")
 */
class City extends \Entities\MY_Entity
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
    protected $active = true;


    /**
     * @Column(name="nome", type="string", length=50, unique=true, nullable=false)
     */
    protected $name;

	public function IsActive() {
		return $this->active;
	}
}