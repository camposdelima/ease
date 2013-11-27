<?php

namespace Entities\Vehicle;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="modelos")
 */
class Model
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
	 *  @OneToOne(targetEntity="Manufacturer")
	 *  @JoinColumn(name="id_fabricante", referencedColumnName="id")
	 */
    protected $manufacturer;
	
    /**
     * @Column(name="nome", type="string", length=10, unique=true, nullable=false)
     */
    protected $name;

	public function IsActive() {
		return $this->active;
	}	
	
	public function ToArray() {
		return array(
		            'id' => $this->id,
		            'active'=> $this->active,
		            'manufacturer'=> $this->manufacturer->ToArray(),
		            'name' => $this->name
		        );
	}
}