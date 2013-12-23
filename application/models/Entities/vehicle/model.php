<?php

namespace Entities\Vehicle;

/**
 * @Entity
 * @Table(name="modelos")
 */
class Model extends \Entities\MY_Entity
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
	 *  @OneToOne(targetEntity="Manufacturer")
	 *  @JoinColumn(name="id_fabricante", referencedColumnName="id")
	 */
    protected $manufacturer;
	
    /**
     * @Column(name="nome", type="string", length=10, unique=true, nullable=false)
     */
    protected $name;
}