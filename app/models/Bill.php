<?php
/**
 * Bill
 *
 * @Table(name="bills")
 * @Entity
 */
class Bill
{
    /**
     * @var integer $id
     *
     * @Column(name="id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $name
     *
     * @Column(name="name", type="string", length=25, nullable=false, unique=true)
     */
    private $name;
    
    /**
     * @var ArrayCollection $payers
     * @OneToMany(targetEntity="Payee", mappedBy="bill")
     */
    private $payers;
    
    /**
     * @var Account
     *
     * @OneToOne(targetEntity="Account", inversedBy="billingAccount")
     * @JoinColumns({
     *   @JoinColumn(name="account_id", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    private $account;
    
    /**
     * @var DateTime $type
     *
     * @Column(name="createTime", type="datetime")
     */
    private $createTime;
    
    
    public function __construct() 
    {
        $this->payers = new Doctrine\Common\Collections\ArrayCollection();
        $this->createTime = new DateTime();
    }

        /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Set name
     *
     * @param string $name
     * @return DxUsers
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    public function getPayers() {
        return $this->payers;
    }
    
    public function getAccount() {
        return $this->account;
    }
    public function setAccount(Account $account) {
        $this->account = $account;
        return $this;
    }

    public function getCreateTime() {
        return $this->createTime;
    }

    public function setCreateTime(DateTime $createTime) {
        $this->createTime = $createTime;
        return $this;
    }
}
