<?php

namespace Drupal\tm_flex_group_training;

use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Config\ConfigFactoryOverrideInterface;
use Drupal\Core\Config\StorageInterface;

/**
 * Class SocialGroupSecretConfigOverride.
 *
 * @package Drupal\social_group_secret
 */
class TmFlexGroupTrainingConfigOverride implements ConfigFactoryOverrideInterface {

  /**
   * The config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * Constructs the configuration override.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config factory.
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->configFactory = $config_factory;
  }

  /**
   * Load overrides.
   */
  public function loadOverrides($names) {
    $overrides = [];    

    $config_names = [
      'search_api.index.social_all',
      'search_api.index.social_groups',
    ];

    foreach ($config_names as $config_name) {
      if (in_array($config_name, $names)) {
        $overrides[$config_name] = [
          'field_settings' => [
            'rendered_item' => [
              'configuration' => [
                'view_mode' => [
                  'entity:group' => [
                    'tm_training' => 'teaser',
                  ],
                ],
              ],
            ],
          ],
        ];
      }
    }

    $config_names = [
      'views.view.search_all',
      'views.view.search_groups',
    ];

    foreach ($config_names as $config_name) {
      if (in_array($config_name, $names)) {
        $overrides[$config_name] = [
          'display' => [
            'default' => [
              'display_options' => [
                'row' => [
                  'options' => [
                    'view_modes' => [
                      'entity:group' => [
                        'tm_training' => 'teaser',
                      ],
                    ],
                  ],
                ],
              ],
            ],
          ],
        ];
      }
    }

    $config_names = [
      'views.view.group_members',
      'views.view.group_manage_members',
    ];

    foreach ($config_names as $config_name) {
      if (in_array($config_name, $names)) {
        $overrides[$config_name] = [
          'display' => [
            'default' => [
              'display_options' => [
                'filters' => [
                  'type' => [
                    'value' => [
                      'tm_training-group_membership' => 'tm_training-group_membership',
                    ],
                  ],
                ],
              ],
            ],
          ],
        ];
      }
    }

    $config_names = [
      'views.view.group_events' => 'tm_training-group_node-event',
      'views.view.group_topics' => 'tm_training-group_node-topic',
    ];

    foreach ($config_names as $config_name => $content_type) {
      if (in_array($config_name, $names)) {
        $overrides[$config_name] = [
          'display' => [
            'default' => [
              'display_options' => [
                'arguments' => [
                  'gid' => [
                    'validate_options' => [
                      'bundles' => [
                        'tm_training' => 'tm_training',
                      ],
                    ],
                  ],
                ],
                'filters' => [
                  'type' => [
                    'value' => [
                      $content_type => $content_type,
                    ],
                  ],
                ],
              ],
            ],
          ],
        ];
      }
    }

    $config_name = 'block.block.views_block__group_managers_block_list_managers';

    if (in_array($config_name, $names, FALSE)) {
      $overrides[$config_name] = [
        'visibility' => [
          'group_type' => [
            'group_types' => [
              'tm_training' => 'tm_training',
            ],
          ],
        ],
      ];
    }

    $config_name = 'block.block.membershiprequestsnotification';

    if (in_array($config_name, $names, FALSE)) {
      $overrides[$config_name] = [
        'visibility' => [
          'group_type' => [
            'group_types' => [
              'tm_training' => 'tm_training',
            ],
          ],
        ],
      ];
    }

    $config_name = 'block.block.membershiprequestsnotification_2';

    if (in_array($config_name, $names, FALSE)) {
      $overrides[$config_name] = [
        'visibility' => [
          'group_type' => [
            'group_types' => [
              'tm_training' => 'tm_training',
            ],
          ],
        ],
      ];
    }

    $config_name = 'message.template.create_content_in_joined_group';
    if (in_array($config_name, $names, FALSE)) {
      $overrides[$config_name]['third_party_settings']['activity_logger']['activity_bundle_entities'] =
        [
          'group_content-tm_training-group_node-event' => 'group_content-tm_training-group_node-event',
          'group_content-tm_training-group_node-topic' => 'group_content-tm_training-group_node-topic',
        ];
    }

    $config_name = 'message.template.join_to_group';
    if (in_array($config_name, $names, FALSE)) {
      $overrides[$config_name]['third_party_settings']['activity_logger']['activity_bundle_entities'] =
        [
          'group_content-tm_training-group_membership' => 'group_content-tm_training-group_membership',
        ];
    }

    $config_name = 'message.template.invited_to_join_group';
    if (in_array($config_name, $names, FALSE)) {
      $overrides[$config_name]['third_party_settings']['activity_logger']['activity_bundle_entities'] =
        [
          'group_content-tm_training-group_invitation' => 'group_content-tm_training-group_invitation',
        ];
    }

    $config_name = 'message.template.approve_request_join_group';
    if (in_array($config_name, $names, FALSE)) {
      $overrides[$config_name]['third_party_settings']['activity_logger']['activity_bundle_entities'] =
        [
          'group_content-tm_training-group_membership' => 'group_content-tm_training-group_membership',
        ];
    }

    $config_name = 'views.view.group_managers';    

    return $overrides;
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheSuffix() {
    return 'TmFlexGroupTrainingConfigOverride';
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheableMetadata($name) {
    return new CacheableMetadata();
  }

  /**
   * {@inheritdoc}
   */
  public function createConfigObject($name, $collection = StorageInterface::DEFAULT_COLLECTION) {
    return NULL;
  }

}
