<?php

namespace Entities;

/**
 * @Entity
 * @Table(name="processos")
 */
class Process extends \Entities\MY_Entity
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
     * @Column(name="nome", type="string", length=20, unique=true, nullable=false)
     */
    protected $name;
}