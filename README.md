# service-bus-zfc-rbac-bridge

Marry Service Bus with ZfcRbac

[![Build Status](https://travis-ci.org/prooph/service-bus-zfc-rbac-bridge.svg)](https://travis-ci.org/prooph/service-bus-zfc-rbac-bridge)
[![Coverage Status](https://coveralls.io/repos/prooph/service-bus-zfc-rbac-bridge/badge.svg?branch=master&service=github)](https://coveralls.io/github/prooph/service-bus-zfc-rbac-bridge?branch=master)
[![Gitter](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/prooph/improoph)

## Important

This library will receive support until December 31, 2019 and will then be deprecated.

For further information see the official announcement here: [https://www.sasaprolic.com/2018/08/the-future-of-prooph-components.html](https://www.sasaprolic.com/2018/08/the-future-of-prooph-components.html)

# Installation

1. Add `"prooph/service-bus-zfc-rbac-bridge": "~1.0"` as requirement to your composer.json.
2. In the `config` folder you will find a [configuration skeleton](config/services.php). The configuration is a simple PHP array flavored with some comments to help you understand the structure.


# Requirements

1. Your Inversion of Control container must implement the [interop-container interface](https://github.com/container-interop/container-interop).
2. ZfcRbac's authorization service should be registered in the container under the `ZfcRbac\Service\AuthorizationService` key.

*Note: Don't worry, if your environment doesn't provide the requirements. You can
always bootstrap the authorization service by hand. Just look at the factories for inspiration in this case.*


# Sample

Assuming a TestQuery with message name `test` and you want to use the route guard and finalize guard together with an assertion (TestAssertion), your config should look like this:

    return [
        'prooph' => [
            'service_bus' => [
                'query_bus' => [
                    'plugins' => [
                        \Prooph\ServiceBus\RouteGuard::class,
                        \Prooph\ServiceBus\FinalizeGuard::class,
                    ]
                ]
            ]
        ],
        'zfc_rbac' => [
            'assertion_manager' => [
                'TestAssertion' => 'TestAssertion',
            ],
            'assertion_map' => [
                'test' => 'TestAssertion'
            ],
            'role_provider' => [
                'ZfcRbac\Role\InMemoryRoleProvider' => [
                    'user' => [
                        'permissions' => [
                            'test'
                        ]
                    ]
                ]
            ]
        ]
    ];

And your TestAssertion should look like this:

    class TestAssertion implements \ZfcRbac\Assertion\AssertionInterface
    {
        public function assert(AuthorizationService $authorizationService, $context = null)
        {
            // return true, if no context present, otherwise your route guard will always fail, because the result is not yet known.
            if (null === $context) {
                return true;
            }
    
            return ($context['owner'] == $authorizationService->getIdentity());
        }
    }

# Support

- Ask questions on Stack Overflow tagged with [#prooph](https://stackoverflow.com/questions/tagged/prooph).
- File issues at [https://github.com/prooph/service-bus-zfc-rbac-bridge/issues](https://github.com/prooph/service-bus-zfc-rbac-bridge/issues).
- Say hello in the [prooph gitter](https://gitter.im/prooph/improoph) chat.


# Contribute

Please feel free to fork and extend existing or add new features and send a pull request with your changes!
To establish a consistent code quality, please provide unit tests for all your changes and may adapt the documentation.

License
-------

Released under the [New BSD License](LICENSE).
