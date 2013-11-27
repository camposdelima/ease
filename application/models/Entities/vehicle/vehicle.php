<?php

namespace Entities\Vehicle;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="veiculos")
 */
class Vehicle
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
	 *  @OneToOne(targetEntity="Entities\branch")
	 *  @JoinColumn(name="id_unidade", referencedColumnName="id")
	 */
    protected $branch;
		
	/**
	 *  @OneToOne(targetEntity="Entities\employee")
	 *  @JoinColumn(name="id_funcionario", referencedColumnName="id")
	 */
    protected $employee;
	/**
	 *  @OneToOne(targetEntity="Model")
	 *  @JoinColumn(name="id_modelo", referencedColumnName="id")
	 */
    protected $model;
	
	/**
	 *  @OneToOne(targetEntity="Color")
	 *  @JoinColumn(name="id_cor", referencedColumnName="id")
	 */
    protected $color;
	
	
    /**
     * @Column(name="placa", type="string", length=7, unique=true, nullable=false)
     */
    protected $plate;

	/**
     * @Column(name="ano", type="integer", nullable=false)
     */
    protected $year;
	
	public function IsActive() {
		return $this->active;
	}	
	
	public function ToArray() {
		return array(
		            'id' => $this->id,
		            'active'=> $this->active,
		            'branch'=> $this->branch->ToArray(),
		            'employee'=> $this->employee->ToArray(),
		            'model'=> $this->model->ToArray(),
		            'color'=> $this->color->ToArray(),
		            'plate' => $this->plate,
		            'year' => $this->year
		        );
	}
}