<?php namespace DancerDeck\Accounts;

use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Hashing\Hasher;
use DancerDeck\Database\Repository;

class Neo4jUserProvider implements UserProvider
{
    /**
     * @var Repository
     */
    private $repo;

    /**
     * The user model.
     *
     * @var User
     */
    private $model;

    /**
     * The hasher implementation.
     *
     * @var Hasher
     */
    private $hasher;

    /**
     * Create a new Neo4j user provider.
     *
     * @param Repository $repo
     * @param User $model
     * @param Hasher $hasher
     */
    public function __construct(Repository $repo, User $model, Hasher $hasher)
    {
        $this->repo = $repo;
        $this->model = $model;
        $this->hasher = $hasher;
    }

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed  $identifier
     * @return UserContract|null
     */
    public function retrieveById($identifier)
    {
        $user = new User(['id' => $identifier]);

        return $this->repo->findOneBy($user);
    }

    /**
     * Retrieve a user by by their unique identifier and "remember me" token.
     *
     * @param  mixed   $identifier
     * @param  string  $token
     * @return UserContract|null
     */
    public function retrieveByToken($identifier, $token)
    {
        $user = new User([
          'id' => $identifier,
          $this->model->getRememberTokenName() => $token,
        ]);

        return $this->repo->findOneBy($user);
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  UserContract  $user
     * @param  string  $token
     * @return void
     */
    public function updateRememberToken(UserContract $user, $token)
    {
        $updateUser = new User([
          'id' => $user->getAuthIdentifier(),
          $this->model->getRememberTokenName() => $token,
        ]);

        $this->repo->updateNode($updateUser);
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return UserContract|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        $user = new User([
          'email' => $credentials['email'],
        ]);

        return $this->repo->findOneBy($user);
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  UserContract  $user
     * @param  array  $credentials
     * @return bool
     */
    public function validateCredentials(UserContract $user, array $credentials)
    {
        return $this->hasher->check($credentials['password'], $user->getAuthPassword());
    }
}
