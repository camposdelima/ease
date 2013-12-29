<?php

namespace Entities;

/**
 * @Entity
 * @Table(name="usuarios")
 */
class User extends \Entities\MY_Entity
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
     * @Column(name="usuario", type="string", length=30, unique=true, nullable=false)
     */
    protected $username;

    /**
     * @Column(name="senha", type="string", length=30, nullable=false)
     */
    protected $password;	
}