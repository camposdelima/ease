<?php

namespace Entities;

/**
 * @Entity
 * @Table(name="aulas")
 */
class Lesson extends \Entities\MY_Entity
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
	 *  @OneToOne(targetEntity="Entities\student")
	 *  @JoinColumn(name="id_aluno", referencedColumnName="id")
	 */
    protected $student;
		
	/**
	 *  @OneToOne(targetEntity="Entities\Employee\employee")
	 *  @JoinColumn(name="id_funcionario", referencedColumnName="id")
	 */
    protected $employee;
	
	  
	 /**
	 *  @OneToOne(targetEntity="Entities\Vehicle\Vehicle")
	 *  @JoinColumn(name="id_veiculo", referencedColumnName="id")
	 */
    protected $vehicle;
	
	/**
	 *  @OneToOne(targetEntity="Entities\Category")
	 *  @JoinColumn(name="id_categoria", referencedColumnName="id")
	 */
    protected $category;
	
	
    /**
     * @Column(name="inicio", nullable=false, type="datetime")
     */
    protected $start;

	/**
     * @Column(name="final", nullable=false, type="datetime")
     */
    protected $end;

}