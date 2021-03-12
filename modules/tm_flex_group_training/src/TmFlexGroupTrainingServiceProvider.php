<?php

namespace Drupal\tm_flex_group_training;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\Core\DependencyInjection\ServiceProviderBase;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class TmFlexGroupTrainingServiceProvider.
 *
 * @package Drupal\tm_flex_group_training
 */
class TmFlexGroupTrainingServiceProvider extends ServiceProviderBase {

  /**
   * {@inheritdoc}
   */
  public function alter(ContainerBuilder $container) {
    $definition = $container->getDefinition('social_course.course_wrapper');
    $definition->setClass('Drupal\tm_flex_group_training\TmTrainingWrapper');
    $definition->setArguments(
      [
        new Reference('entity.manager'),
        new Reference('current_user'),
        new Reference('module_handler')
      ]
    );
  }

}
