<?php

namespace Drupal\custom_social\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Path\CurrentPathStack;

/**
 * Provides a 'FacebookShare' block.
 *
 * @Block(
 *  id = "facebook_share",
 *  admin_label = @Translation("Facebook share"),
 * )
 */
class FacebookShare extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Drupal\Core\Path\CurrentPathStack definition.
   *
   * @var \Drupal\Core\Path\CurrentPathStack
   */
  protected $pathCurrent;
  /**
   * Construct.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param string $plugin_definition
   *   The plugin implementation definition.
   */
  public function __construct(
        array $configuration,
        $plugin_id,
        $plugin_definition,
        CurrentPathStack $path_current
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->pathCurrent = $path_current;
  }
  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('path.current')
    );
  }
  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['facebook_share']['#markup'] = '<div class="fb-share-button" data-href="'. $this->pathCurrent->getPath() .'" data-layout="button" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u='. urlencode($this->pathCurrent->getPath()) .';src=sdkpreparse">Share</a></div>';

    return $build;
  }

}
