<?php
declare(strict_types=1);

/**
 * @author    Aaron Scherer <aequasi@gmail.com>
 * @date      ${YEAR}
 * @license   http://opensource.org/licenses/MIT
 */


namespace Secretary;

use Psr\Cache\CacheItemPoolInterface;
use Psr\SimpleCache\CacheInterface;
use Secretary\Adapter\AdapterInterface;
use Secretary\Adapter\Secret;
use Secretary\Configuration\ManagerConfiguration;
use Secretary\Helper\ArrayHelper;
use Secretary\Helper\OptionsResolverHelper;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class Manager
 *
 * @package Secretary
 */
class Manager
{
    /**
     * @var AdapterInterface
     */
    private $adapter;

    /**
     * Manager constructor.
     *
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @param string $key
     * @param array  $options
     *
     * @return Secret
     */
    public function getSecret(string $key, array $options): Secret
    {
        $resolver = new OptionsResolver();
        $this->adapter->configureSharedOptions($resolver);
        $this->adapter->configureGetSecretOptions($resolver);


        return $this->adapter->getSecret($key, $resolver->resolve($options));
    }

    /**
     * @param array $options
     *
     * @return Secret[]
     */
    public function getSecrets(array $options): array
    {
        $resolver = new OptionsResolver();
        $this->adapter->configureSharedOptions($resolver);
        $this->adapter->configureGetSecretsOptions($resolver);

        return $this->adapter->getSecrets($resolver->resolve($options));
    }

    /**
     * @param string $key
     * @param string $value
     * @param array  $options
     *
     * @return void
     */
    public function putSecret(string $key, string $value, array $options): void
    {
        $resolver = new OptionsResolver();
        $this->adapter->configureSharedOptions($resolver);
        $this->adapter->configurePutSecretOptions($resolver);

        $this->adapter->putSecret($key, $value, $resolver->resolve($options));
    }

    /**
     * @param array $options
     *
     * @return void
     */
    public function putSecrets(array $options): void
    {
        $resolver = new OptionsResolver();
        $this->adapter->configureSharedOptions($resolver);
        $this->adapter->configurePutSecretsOptions($resolver);

        $this->adapter->putSecrets($resolver->resolve($options));
    }

    /**
     * @param string $key
     * @param string $value
     * @param array  $options
     *
     * @return void
     */
    public function deleteSecret(string $key, array $options): void
    {
        $resolver = new OptionsResolver();
        $this->adapter->configureSharedOptions($resolver);
        $this->adapter->configurePutSecretOptions($resolver);

        $this->adapter->deleteSecret($key, $resolver->resolve($options));
    }

    /**
     * @param array $options
     *
     * @return void
     */
    public function deleteSecrets(array $options): void
    {
        $resolver = new OptionsResolver();
        $this->adapter->configureSharedOptions($resolver);
        $this->adapter->configureDeleteSecretsOptions($resolver);

        $this->adapter->deleteSecrets($resolver->resolve($options));
    }

    /**
     * @return AdapterInterface
     */
    public function getAdapter(): AdapterInterface
    {
        return $this->adapter;
    }
}
