<?php

namespace Entities\Vehicle;

/**
 * @Entity
 * @Table(name="veiculos")
 */
class Vehicle extends \Entities\MY_Entity
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
    protected $active = TRUE;

  	/**
	 *  @OneToOne(targetEntity="Entities\branch")
	 *  @JoinColumn(name="id_unidade", referencedColumnName="id")
	 */
    protected $branch;
		
	/**
	 *  @OneToOne(targetEntity="Entities\Employee\employee")
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
	
	public function ToArray($all = false, $fields = null) {			
		if(!$all && $fields == null)
			$fields = array("id", "plate", "model");
			
		return parent::ToArray($all , $fields);
	}
}