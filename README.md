testingFlow
===========

Example for BasicFlowBundle

###Information

What we have:

- We have default controller with four actions (three of them are flow actions)
- controller implements StepInterface
- step actions sets their respective data, and interceptors checks whether previous steps have data defined
- if they dont have data defined - reditect
- check configuration in `config.yml` `basic_flow`
- check defined interceptors in `services.yml`
- check defined twig extension in `services.yml` basic_flow.twig_extension.flow that uses predefined session retainer
- check templates usage of steps `app/Resources/views/default/stepx.html.twig`

### Testing

- start symfony built in php server `php bin/console server:start`
- go to `http://localhost:3000`

###Warning

This example doesn't use `$retainer->clearPaging()` after steps are completed. It must be called in order
to clear retainer data for correct new flow beginning.

Also be aware not to store sensitive information in cookie retainer. Use session retainer, or create your customer, more secure one.