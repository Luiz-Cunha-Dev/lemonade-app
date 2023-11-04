<?php 

namespace app\models;

/**
 * User model
 * 
 * Represents a user in the application
 * 
 * @package app\models
 */ 
class UserModel {

    /**
     * User id
     * 
     * @var integer $idUser
     */
    private $idUser;

    /**
     * User name
     * 
     * @var string $name
     */
    private $name;

    /**
     * User last name
     * 
     * @var string $lastName
     */
    private $lastName;

    /**
     * User email
     * 
     * @var string $email
     */
    private $email;

    /**
     * User nickname
     * 
     * @var string $nickname
     */
    private $nickname;

    /**
     * User encrypted password
     * 
     * @var string $password
     */
    private $password;

    /**
     * User phone
     * 
     * @var string $phone
     */
    private $phone;

    /**
     * User birth date
     * 
     * @var string $birthDate
     */
    private $birthDate;

    /**
     * User profile picture (path)
     * 
     * @var string $profilePicture
     */
    private $profilePicture;

    /**
     * User street
     * 
     * @var string $street
     */
    private $street;

    /**
     * User street number
     * 
     * @var integer $streetNumber
     */
    private $streetNumber;

    /**
     * User district
     * 
     * @var string $district
     */
    private $district;

    /**
     * User address complement
     * 
     * @var string $complement
     */
    private $complement;

    /**
     * User postal code
     * 
     * @var string $postalCode
     */
    private $postalCode;

    /**
     * User first access
     * 
     * @var boolean $firstAccess
     */
    private $firstAccess;

    /**
     * User city (fk)
     * 
     * @var integer $idCity
     */
    private $idCity;

    /**
     * User type (fk)
     * 
     * @var integer $idUserType
     */
    private $idUserType;

    /**
     * Class constructor
     * 
     * @param integer $idUser user id
     * @param string $name user first name
     * @param string $lastName user last name
     * @param string $email user email
     * @param string $nickname user nickname
     * @param string $password user encrypted password
     * @param string $phone user phone
     * @param string $birthDate user birth date
     * @param string $profilePicture user profile picture (path)
     * @param string $street user street
     * @param integer $streetNumber user street number
     * @param string $district user district
     * @param string $complement user address complement
     * @param string $postalCode user postal code
     * @param boolean $firstAccess user first access
     * @param integer $idCity user city (fk)
     * @param integer $idUserType user type (fk)
     * 
     * @return UserModel user
     */
    public function __construct($idUser, $name, $lastName, $email, $nickname, $password, $phone, $birthDate, $profilePicture, 
    $street, $streetNumber, $district, $complement, $postalCode, $firstAccess, $idCity, $idUserType) {
        $this->idUser = (int)$idUser || null;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->nickname = $nickname;
        $this->password = $password;
        $this->phone = $phone;
        $this->birthDate = $birthDate;
        $this->profilePicture = $profilePicture || null;
        $this->street = $street;
        $this->streetNumber = (int)$streetNumber;
        $this->district = $district;
        $this->complement = $complement || null;
        $this->postalCode = $postalCode;
        $this->firstAccess = (bool)$firstAccess || true;
        $this->idCity = (int)$idCity;
        $this->idUserType = (int)$idUserType;
    }

    /**
     * Get user id
     * 
     * @return integer Returns the user id
     */
    public function getIdUser() {
        return $this->idUser;
    }

    /**
     * Get user first name
     * 
     * @return string Returns the user first name
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Get user last name
     * 
     * @return string Returns the user last name
     */
    public function getLastName() {
        return $this->lastName;
    }

    /**
     * Get user email
     * 
     * @return string Returns the user email
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Get user nickname
     * 
     * @return string Returns the user nickname
     */
    public function getNickname() {
        return $this->nickname;
    }

    /**
     * Get user password (encrypted)
     * 
     * @return string Returns the user encrypted password
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Get user password phone
     * 
     * @return string Returns the user phone
     */
    public function getPhone() {
        return $this->phone;
    }

    /**
     * Get user birth date
     * 
     * @return string Returns the user birth date
     */
    public function getBirthDate() {
        return $this->birthDate;
    }

    /**
     * Get user birth date formatted
     * 
     * @return DateTimeImmutable Returns the user birth date formatted
     */
    public function getBirthDateFormatted() {
        $birthDateFormatted = new \DateTimeImmutable($this->birthDate);
        return $birthDateFormatted->format('d/m/Y');
    }

    /**
     * Get user profile picture (path)
     * 
     * @return string Returns the user profile picture (path)
     */
    public function getProfilePicture() {
        return $this->profilePicture;
    }

    /**
     * Get user street
     * 
     * @return string Returns the user street
     */
    public function getStreet() {
        return $this->street;
    }

    /**
     * Get user street number
     * 
     * @return integer Returns the user street number
     */
    public function getStreetNumber() {
        return $this->streetNumber;
    }

    /**
     * Get user district
     * 
     * @return string Returns the user district
     */
    public function getDistrict() {
        return $this->district;
    }

    /**
     * Get user address complement
     * 
     * @return string Returns the user address complement
     */
    public function getComplement() {
        return $this->complement;
    }

    /**
     * Get user postal code
     * 
     * @return string Returns the user postal code
     */
    public function getPostalCode() {
        return $this->postalCode;
    }

    /**
     * Get user first access
     * 
     * @return boolean Returns if it is the user's first access
     */
    public function getFirstAccess() {
        return $this->firstAccess;
    }

    /**
     * Get user city (fk)
     * 
     * @return string Returns the user city (fk)
     */
    public function getIdCity() {
        return $this->idCity;
    }

    /**
     * Get user type (fk)
     * 
     * @return string Returns the user type (fk)
     */
    public function getIdUserType() {
        return $this->idUserType;
    }

    /**
     * Set user id
     * 
     * @param integer $idUser user id
     */
    public function setIdUser($idUser) {
        $this->idUser = $idUser;
    }

    /**
     * Set user first name
     * 
     * @param string $name user first name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Set user last name
     * 
     * @param string $lastName user last name
     */
    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    /**
     * Set user email
     * 
     * @param string $email user email
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * Set user nickname
     * 
     * @param string $nickname user nickname
     */
    public function setNickname($nickname) {
        $this->nickname = $nickname;
    }

    /**
     * Set user password (encrypted)
     * 
     * @param string $password user encrypted password
     */
    public function setPassword($password) {
        $this->password = $password;
    }

    /**
     * Set user password phone
     * 
     * @param string $phone user phone
     */
    public function setPhone($phone) {
        $this->phone = $phone;
    }

    /**
     * Set user birth date
     * 
     * @param string $birthDate user birth date
     */
    public function setBirthDate($birthDate) {
        $this->birthDate = new \DateTimeImmutable($birthDate);
    }

    /**
     * Set user profile picture (path)
     * 
     * @param string $profilePicture user profile picture (path)
     */
    public function setProfilePicture($profilePicture) {
        $this->profilePicture = $profilePicture;
    }

    /**
     * Set user street
     * 
     * @param string $street user street
     */
    public function setStreet($street) {
        $this->street = $street;
    }

    /**
     * Set user street number
     * 
     * @param integer $streetNumber user street number
     */
    public function setStreetNumber($streetNumber) {
        $this->streetNumber = $streetNumber;
    }

    /**
     * Set user district
     * 
     * @param string $district user district
    **/
    public function setDistrict($district) {
        $this->district = $district;
    }

    /**
     * Set user address complement
     * 
     * @param string $complement user address complement
     */
    public function setComplement($complement) {
        $this->complement = $complement;
    }

    /**
     * Set user postal code
     * 
     * @param string $postalCode user postal code
     */
    public function setPostalCode($postalCode) {
        $this->postalCode = $postalCode;
    }

    /**
     * Set user first access
     * 
     * @param boolean $firstAccess user first access
     */
    public function setFirstAccess($firstAccess) {
        $this->firstAccess = $firstAccess;
    }

    /**
     * Set user city (fk)
     * 
     * @param integer $idCity user city (fk)
     */
    public function setIdCity($idCity) {
        $this->idCity = $idCity;
    }

    /**
     * Set user type (fk)
     * 
     * @param integer $idUserType user type (fk)
     */
    public function setIdUserType($idUserType) {
        $this->idUserType = $idUserType;
    }

    /**
     * Converts the user to an array.
     * 
     * @return array Returns the user as an array
     */
    public function toArray() {
        return [
            'idUser' => $this->idUser,
            'name' => $this->name,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'nickname' => $this->nickname,
            'password' => $this->password,
            'phone' => $this->phone,
            'birthDate' => $this->birthDate,
            'profilePicture' => $this->profilePicture,
            'street' => $this->street,
            'streetNumber' => $this->streetNumber,
            'district' => $this->district,
            'complement' => $this->complement,
            'postalCode' => $this->postalCode,
            'firstAccess' => $this->firstAccess,
            'idCity' => $this->idCity,
            'idUserType' => $this->idUserType
        ];
    }

}
