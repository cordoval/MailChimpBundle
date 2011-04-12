MailChimpBundle
===============

The MailChimp API for your Symfony2 projects.

Installation
------------

First, you need to add the MailChimp library in your project:

    $ git submodule add git://github.com/switzer/mailchimp.git vendor/mailchimp

And the bundle:

    $ git submodule add git://github.com/jirafe/MailChimpBundle.git vendor/bundles/Jirafe/Bundle/MailChimpBundle

Then, add it to the autoloader:

    // app/autoload.php
    $loader->registerNamespaces(array(

        // ... other namespaces

        'Jirafe'                         => __DIR__ . '/../vendor/bundles',
        'Mailchimp'                      => __DIR__ . '/../vendor/mailchimp/src',
    ));

Add the bundle to your kernel:

    // app/AppKernel.php
    
    $bundles = array(
        
        // ... other bundles

        new Jirafe\Bundle\MailChimpBundle\JirafeMailChimpBundle(),
    );

Finally, configure it:

    # app/config/config.yml
    # MailChimp Configuration
    jirafe_mail_chimp:
        api_key:    yourSecretKey   # your api key
        connection: http            # must be "http", "https" or "stub" (default "http")

Usage
-----

In your controller, you can easily access the MailChimp api:

    // src/FooVendor/Bundle/BarBundle/Controller/DefaultController

    public function foobarAction()
    {
        $mailChimp = $this->get('mail_chimp.client');

        $mailChimp->campaignUnschedule($cid);
    }
