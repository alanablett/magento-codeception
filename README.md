# Example of Magento with Codeception testing

***NOTE: This example repo is against a clean version of magento 1.9.0.1 with the sample data installed. For ease I also added my own account to log in to the admin area and also changed a frontend customer password so I could log in as them.***

Take a look at the ```composer.json``` file to see how we are pulling in codeception.

Once we have run ```composer install``` we can then bootstrap our codeception project by running ```vendor/bin/codecept bootstrap``` from the root of our project. If you want to just be able to run ```codecept bootstrap``` then add ```vendor/bin``` to your PATH variable so you can always run composer binaries from the root of your project.

Now for our acceptance tests (tests that we would run through a browser), we will need to change the file ```tests/acceptance.suite.yml```. Inside this file change the ```modules: config: PhpBrowser: url:``` node to the url of the magento site you are running. ***For more info about codeception you can find the documentation at http://codeception.com/ and read through the guides.***

We can now generate a test. We could also write it all ourselves if we wanted to but the generation tool will create the file for us ```codecept generate:cept acceptance Signin```. This will generate a ```cept``` test in the ```acceptance``` suite called ```Signin```. You can read more about the different types of tests and formats at the codeception website. We now have a file ```tests/acceptance/SigninCept.php``` that we can add our test to.

We describe what we want to do, then perform our actions, then assert that something is true or not. Maybe we're checking that certain text appears on the screen for example. You can see this in ```tests/acceptance/SigninCept.php``` where we navigate to the login page, fill in the fields, click login, and then expect to see a certain message appears when we do so.

You can see an extension of this test in ```SigninAsAdminCept.php``` where we actually extract our logging in to the helper class. Instead of repeating an admin login over and over again, we have defined a new method meaning we can simply do ```$I->logInAsAdminUser();```. This code is extracted into the helper class which can be found in ```tests/_support/AcceptanceHelper.php```. As you can see inside the ```logInAsAdminUser``` method, we grab an instance of the ```PhpBrowser``` module so that we can perform the navigation and form filling as we did before.

***NOTE: If you change configuration, or extend the helper classes, remember to run ```codecept build``` from the command line before running your tests again. This will regenerate the test class based on the new config and helper classes. They are compiled into the main test class found at ```tests/acceptance/AcceptanceTester.php```. So dont go changing that file because it will be regenerated every time you make config and helper changes.***

We could take this further by logging in, setting a special price, setting the name etc of a product, and then checking that the relevant text has been changed on the frontend. The possibilities are endless.

Once you are ready to run the tests simply do ```vendor/bin/codecept run```. Or just ```codecept run``` if you've added ```vendor/bin``` to your PATH.

***NOTE: The PhpBrowser module does not deal with Javascript/Ajax without manual configuration. If you want to actually see the browser open, and see the interaction between pages then use the Selenium WebDriver module.***

I have included the WebDriver module in the configuration file and have also shown how you would pull than in instead of the PhpBrowser in the ```tests/_support/AcceptanceHelper.php``` file. These are the settings that selenium would use when it is performing the tests. In order to run selenium you would also need the selenium server before you execute the tests. You can get it here http://docs.seleniumhq.org/download/. Just click the selenium server to download the jar file. Then, to run the jar file you will need java installed on your machine and run run the following ```java -jar selenium-server-standalone-2.44.0.jar```. You should then be able to run your tests and the browser should automatically open and run through.