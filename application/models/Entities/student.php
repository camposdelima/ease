<?php

namespace Entities;

/**
 * @Entity
 * @Table(name="alunos")
 */
class Student extends My_Entity
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
     * @Column(name="pai", type="string", length=200)
     */
    protected $father;
	
	 /**
     * @Column(name="mae", type="string", length=200)
     */
    protected $mother;

	/**
     * @Column(name="nascimento", type="datetime")
     */
    protected $birthdate;
	
	/**
     * @Column(name="cadastro", type="datetime")
     */
    protected $registered;
    
	 /**
     * @Column(name="sexo", type="boolean", nullable=false)
     */
    protected $sex = 1;
    
     /**
     * @Column(name="rua", type="string", length=200)
     */
    protected $street;
	
	/**
     * @Column(name="numero", type="integer")
     */
    protected $number;
	
	/**
     * @Column(name="complemento", type="string", length=100)
     */
    protected $complementary;
	
	/**
     * @Column(name="bairro", type="string", length=100)
     */
    protected $district;
	
	/**
     * @Column(name="cep", type="string", length=8)
     */
    protected $cep;	
	
	/**
     * @Column(name="renach", type="string", length=11)
     */
    protected $renach;
	
	/**
     * @Column(name="telefone", type="string", length=10)
     */
    protected $phone;
	
	/**
     * @Column(name="celular", type="string", length=11)
     */
    protected $cellularPhone;
	
	/**
     * @Column(name="email", type="string", length=200)
     */
    protected $email;
	
	public function __construct()
    {
    	//echo $this->registered."|";
        $this->registered = new \Datetime("now");
		
    }
 
}