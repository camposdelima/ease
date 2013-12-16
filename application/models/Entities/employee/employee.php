<?php

namespace Entities\Employee;

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
	 *  @OneToOne(targetEntity="Entities\school")
	 *  @JoinColumn(name="id_autoescola", referencedColumnName="id")
	 */
    protected $school;
      
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
    
	public function IsActive() {
		return $this->active;
	}
	
	public function GetID() {
		return $this->id;
	}	
	
	public function Set($data) {
		
		if(key_exists('school', $data))
			$this->school 	= $data->school;
		
		if(key_exists('departments', $data))
			$this->departments = $data->departments;
		
		
		if(key_exists('user', $data)) {
			$this->user 	= $data->user;
			
		}
		
		if(isset($data->active))
			$this->active 	= $data->active;
		
		if(isset($data->name))
			$this->name 	= $data->name;
		
	}
	
	public function ToArray() {		
		
		return array(
		            'id' => $this->id,
		            'active'=> $this->active,
		          	'school'=> ($this->school?$this->school->ToArray():null),
		         	'departments' => ($this->departments?EntitiesToList($this->departments->ToArray()):null),
		           	'user'=> ($this->user?$this->user->ToArray():null),
		            'name' => $this->name
		        );
	}
}