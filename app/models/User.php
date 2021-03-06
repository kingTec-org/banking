<?php

use Doctrine\Common\Collections\ArrayCollection;

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

/**
 * User Entity
 *
 * @Table(name="users")
 * @Entity
 */
class User extends Eloquent implements UserInterface, RemindableInterface
{

    CONST ADMIN     = 1;
    CONST USER      = 2;
    CONST MANAGER   = 3;

    /**
    * The database table used by the model.
    *
    * @var string
    */
   protected $table = 'users';

   /**
    * The attributes excluded from the model's JSON form.
    *
    * @var array
    */
   protected $hidden = array('password');
        
    /**
     * @var integer $id
     *
     * @Column(name="id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $username
     *
     * @Column(name="username", type="string", length=30, nullable=false, unique=true)
     */
    private $username;

    /**
     * @var string $password
     *
     * @Column(name="password", type="string", length=64, nullable=false)
     */
    private $password;

    /**
     * @var string $email
     *
     * @Column(name="email", type="string", length=100, nullable=true)
     */
    private $email;


    /**
     * @var string $roolId
     *
     * @Column(name="rool_id", type="smallint", nullable=false)
     */
    private $roolId;

    /**
     * @var string $firstName
     *
     * @Column(name="first_name", type="string", length=50, nullable=true)
     */
    private $firstName;

    /**
     * @var string $lastName
     *
     * @Column(name="last_name", type="string", length=50, nullable=true)
     */
    private $lastName;


    /**
     * @var string $accounts
     *
     * @OneToMany(targetEntity="Account", mappedBy="user")
     **/
    private $accounts;


    /**
     * @var \DateTime $birthDate
     *
     * @Column(name="birth_date", type="datetime", nullable=false)
     */
    private $birthDate;

    /**
     * @var string $address
     *
     * @Column(name="address", type="text", nullable=true)
     */
    private $address;
    
    /**
     * @var string $address
     *
     * @Column(name="phone", type="text", nullable=true)
     */
    private $phone;
    

    /**
     * @var \DateTime $createDate
     *
     * @Column(name="create_date", type="datetime", nullable=false)
     */
    private $createDate;

    /**
     * @var \DateTime $modifyDate
     *
     * @Column(name="update_date", type="datetime", nullable=false)
     */
    private $updateDate;
    
    /**
     * @var ArrayCollection $payees
     * @OneToMany(targetEntity="Payee", mappedBy="user")
     * @var Payee
     */
    private $payees;

    /**
     * @var ArrayCollection $investments
     *
     * @OneToMany(targetEntity="Investment", mappedBy="user")
     */
    private $investments;

    public function __construct()
    {
        $this->accounts   = new ArrayCollection();
        $this->payees     = new ArrayCollection();
        $this->updateDate = new DateTime('now');
    }

    /**
     * Return the id
     * @return $this;
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $accounts
     * @return $this;
     */
    public function setAccounts($accounts)
    {
        $this->accounts = $accounts;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccounts()
    {
        return $this->accounts;
    }

    /**
     * @param string $firstName
     * @return $this
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $lastName
     * @return $this
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set Password
     *
     * @param string $emailAddress
     * @return $this
     */
    public function setEmail($emailAddress)
    {
        $this->email = $emailAddress;
        return $this;
    }

    /**
     * Get Password
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $roolId
     * @return $this
     */
    public function setRoolId($roolId)
    {
        $this->roolId = $roolId;
        return $this;
    }

    /**
     * @return string
     */
    public function getRoolId()
    {
        return $this->roolId;
    }

    /**
     * @param string $username
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param \DateTime $updateDate
     * @return $this;
     */
    public function setUpdateDate($updateDate)
    {
        $this->updateDate = $updateDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    /**
     * @param \DateTime $createDate
     * @return $this;
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

    /**
     * @param string $address
     * @return $this;
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param \DateTime $birthDate
     * @return $this;
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }
    
    public function getPhone() {
        return $this->phone;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
        return $this;
    }

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
        return $this->email;
	}
        
    public function getPayees()
    {
        return $this->payees;
    }
    public function getInvestments() {
        return $this->investments;
    }

    public function setInvestments(ArrayCollection $investments) {
        $this->investments = $investments;
        return $this;
    }

    public static function getRules()
    {
        return array('first_name'               => 'required',
                     'last_name'                => 'required',
                     'password'                 => 'required|alpha_num|min:6|confirmed',
                     'password_confirmation'    => 'required|alpha_num|min:6',
                     'email'                    => 'required|email|unique:users',
                     'username'                 => 'required|alpha_num|unique:users',
                     'birth_date'               => 'required|date',
                     'phone'                    => 'required|numeric' 

        );
    }

    public static function getRulesForChangePassword()
    {
        return array('old_password'             => 'required|alpha_num',
                     'password'                 => 'required|alpha_num|min:6|confirmed',
                     'password_confirmation'    => 'required|alpha_num|min:6'

        );
    }
    
}
