<?php

namespace Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="alunos")
 */
class Student
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
	 *  @OneToOne(targetEntity="branch")
	 *  @JoinColumn(name="id_unidade", referencedColumnName="id")
	 */
    protected $branch;
		
	/**
	 *  @OneToOne(targetEntity="user")
	 *  @JoinColumn(name="id_usuario", referencedColumnName="id")
	 */
    protected $user;
	
	/**
	 *  @OneToOne(targetEntity="city")
	 *  @JoinColumn(name="id_cidade", referencedColumnName="id")
	 */
    protected $city;
	
	/**
	 *  @OneToOne(targetEntity="city")
	 *  @JoinColumn(name="id_naturalidade", referencedColumnName="id")
	 */
    protected $placeOfBirth;
	
	
    /**
     * @Column(name="nome", type="string", length=100, nullable=false)
     */
    protected $name;
	
	/**
     * @Column(name="sobrenome", type="string", length=200, nullable=false)
     */
    protected $lastname;
	
	/**
     * @Column(name="pai", type="string", length=200, nullable=true)
     */
    protected $father;
	
	 /**
     * @Column(name="mae", type="string", length=200, nullable=true)
     */
    protected $mother;

	/**
     * @Column(name="nascimento", type="datetime", nullable=false)
     */
    protected $birthdate;
	
	/**
     * @Column(name="cadastro", type="datetime", nullable=false)
     */
    protected $registered;
    
	 /**
     * @Column(name="sexo", type="boolean", nullable=false)
     */
    protected $sex;
    
     /**
     * @Column(name="rua", type="string", length=200, nullable=true)
     */
    protected $street;
	
	/**
     * @Column(name="numero", type="integer", nullable=true)
     */
    protected $number;
	
	/**
     * @Column(name="complemento", type="string", length=100, nullable=true)
     */
    protected $complementary;
	
	/**
     * @Column(name="bairro", type="string", length=100, nullable=true)
     */
    protected $district;
	
	/**
     * @Column(name="cep", type="string", length=8, nullable=true)
     */
    protected $cep;	
	
	/**
     * @Column(name="renach", type="string", length=11, nullable=true)
     */
    protected $renach;
	
	/**
     * @Column(name="telefone", type="string", length=10, nullable=true)
     */
    protected $phone;
	
	/**
     * @Column(name="celular", type="string", length=11, nullable=true)
     */
    protected $cellularPhone;
	
	/**
     * @Column(name="email", type="string", length=200, nullable=true)
     */
    protected $email;
    
	public function IsActive() {
		return $this->active;
	}	
	
	public function ToArray() {
		return array(
		            'id' => $this->id,
		            'active'=> $this->active,
		            'branch'=> $this->branch->ToArray(),
		            'user'=> $this->user->ToArray(),
		            'city'=> $this->city->ToArray(),
		            'placeOfBirth'=> $this->placeOfBirth->ToArray(),
		            'name'=> $this->name,
		            'lastname'=> $this->lastname,
		            'father'=> $this->father,
		            'mother'=> $this->mother,
		            'birthdate' => $this->birthdate,
		            'registered' => $this->registered,
		            'sex' => $this->sex,
		            'street' => $this->street,
		            'number' => $this->number,
		            'complementary' => $this->complementary,
		         	'district' => $this->district,
		            'cep' => $this->cep,
		            'renach' => $this->renach,
		            'phone' => $this->phone,
		            'cellularPhone' => $this->cellularPhone,
		            'email' => $this->email		            
		        );
	}
}