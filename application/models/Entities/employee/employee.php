<?php

namespace Entities\Employee;

/**
 * @Entity
 * @Table(name="funcionarios")
 */
class Employee extends \Entities\MY_Entity
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
     * @ManyToMany(targetEntity="Department")
     * @JoinTable(name="funcionariospordepartamentos",
     *      joinColumns={@JoinColumn(name="id_funcionario", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="id_departamento", referencedColumnName="id")}
     * )
     */
	protected $departments;
	
	/**
	 *  @OneToOne(targetEntity="Entities\user")
	 *  @JoinColumn(name="id_usuario", referencedColumnName="id")
	 */
    protected $user;
	
    /**
     * @Column(name="nome", type="string", length=50, unique=true, nullable=false)
     */
    protected $name;

 	public function __construct()
    {
        $this->departaments = new ArrayCollection();
    }		
}