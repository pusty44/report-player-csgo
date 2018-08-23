<?php
/**
 * Created by PhpStorm.
 * User: pusty
 * Date: 05.08.2018
 * Time: 15:39
 */

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Knojector\SteamAuthenticationBundle\User\AbstractSteamUser;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\Role\Role;

/**
 * @ORM\Table(name="www_users")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields="email", message="Email jest już w użyciu")
 * @UniqueEntity(fields="username", message="Login jest już w użyciu")
 */
class User extends AbstractSteamUser implements AdvancedUserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     */
    private $username;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;
    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="array")
     */
    protected $roles;

    /**
     * @ORM\Column(name="steam_id", type="integer", nullable=true)
     */
    protected $steamId;
    /**
     * @ORM\Column(name="profile_name", type="string", nullable=true)
     */
    protected $profileName;
    /**
     * @ORM\Column(name="profile_url", type="string", nullable=true)
     */
    protected $profileUrl;
    /**
     * @ORM\Column(name="last_log_off", type="datetime", nullable=true)
     */
    protected $lastLogOff;
    /**
     * @ORM\Column(name="comment_permission", type="integer", nullable=true)
     */
    protected $commentPermission;
    /**
     * @ORM\Column(name="avatar", type="string", nullable=true)
     */
    protected $avatar;
    /**
     * @ORM\Column(name="persona_state", type="integer", nullable=true)
     */
    protected $personaState;
    /**
     * @ORM\Column(name="primary_clan_id", type="integer", nullable=true)
     */
    protected $primaryClanId;
    /**
     * @ORM\Column(name="join_date", type="datetime")
     */
    protected $joinDate;
    /**
     * @ORM\Column(name="country_code", type="string", nullable=true)
     */
    protected $countryCode;

    public function __construct()
    {
        $this->isActive = true;
        $this->roles = array('ROLE_USER');
        $this->joinDate = new Datetime();
        $this->communityVisibilityState = 1;
        $this->profileState = 1;
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {
    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->isActive;
    }

    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->isActive,
        ));
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->isActive,
            ) = unserialize($serialized);
    }



    /**
     * @return mixed
     */
    public function getisActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive): void
    {
        $this->isActive = $isActive;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getRoles() :array
    {
        $roles = [];
        foreach ($this->roles as $role) {
            $roles[] = new Role($role);
        }
        return $roles;
    }

    /**
     * @return int
     */
    public function getCommunityVisibilityState(): int
    {
        return $this->communityVisibilityState;
    }

    /**
     * @param int $communityVisibilityState
     */
    public function setCommunityVisibilityState(int $communityVisibilityState): void
    {
        $this->communityVisibilityState = $communityVisibilityState;
    }

    /**
     * @return int
     */
    public function getProfileState(): int
    {
        return $this->profileState;
    }

    /**
     * @param int $profileState
     */
    public function setProfileState(int $profileState): void
    {
        $this->profileState = $profileState;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getSteamId():int
    {
        return $this->steamId;
    }

    /**
     * @param mixed $steamId
     */
    public function setSteamId($steamId): void
    {
        $this->steamId = $steamId;
    }

    /**
     * @return mixed
     */
    public function getProfileName():string
    {
        return $this->profileName;
    }

    /**
     * @param mixed $profileName
     */
    public function setProfileName($profileName): void
    {
        $this->profileName = $profileName;
    }

    /**
     * @return mixed
     */
    public function getProfileUrl():string
    {
        return $this->profileUrl;
    }

    /**
     * @param mixed $profileUrl
     */
    public function setProfileUrl($profileUrl): void
    {
        $this->profileUrl = $profileUrl;
    }

    /**
     * @return mixed
     */
    public function getLastLogOff():DateTime
    {
        return $this->lastLogOff;
    }

    /**
     * @param mixed $lastLogOff
     */
    public function setLastLogOff($lastLogOff): void
    {
        $this->lastLogOff = $lastLogOff;
    }

    /**
     * @return mixed
     */
    public function getCommentPermission():int
    {
        return $this->commentPermission;
    }

    /**
     * @param mixed $commentPermission
     */
    public function setCommentPermission($commentPermission): void
    {
        $this->commentPermission = $commentPermission;
    }

    /**
     * @return mixed
     */
    public function getAvatar():string
    {
        return $this->avatar;
    }

    /**
     * @param mixed $avatar
     */
    public function setAvatar($avatar): void
    {
        $this->avatar = $avatar;
    }

    /**
     * @return mixed
     */
    public function getPersonaState():int
    {
        return $this->personaState;
    }

    /**
     * @param mixed $personaState
     */
    public function setPersonaState($personaState): void
    {
        $this->personaState = $personaState;
    }

    /**
     * @return mixed
     */
    public function getPrimaryClanId():int
    {
        return $this->primaryClanId;
    }

    /**
     * @param mixed $primaryClanId
     */
    public function setPrimaryClanId($primaryClanId): void
    {
        $this->primaryClanId = $primaryClanId;
    }

    /**
     * @return mixed
     */
    public function getJoinDate():DateTime
    {
        return $this->joinDate;
    }

    /**
     * @param mixed $joinDate
     */
    public function setJoinDate($joinDate): void
    {
        $this->joinDate = $joinDate;
    }

    /**
     * @return mixed
     */
    public function getCountryCode():string
    {
        return $this->countryCode;
    }

    /**
     * @param mixed $countryCode
     */
    public function setCountryCode($countryCode): void
    {
        $this->countryCode = $countryCode;
    }



}