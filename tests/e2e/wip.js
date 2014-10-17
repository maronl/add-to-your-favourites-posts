// test work in progess. once completed they will be moved to the dist.js
describe('Hello World form', function() {

    beforeEach(function() {
        return browser.ignoreSynchronization = true;
    });

    it("user success login", function () {

        login_steps();

        expect(element(by.id("login_error")).isPresent()).toBe(false);

    });

    it("new settings submenu is present", function () {

        browser.get('/wp-admin/options-general.php');

        browser.sleep( 2000 );

        expect(element(by.css('[href="options-general.php?page=atyfp-plugin-options"]')).isPresent()).toBe(true);

    });

    it("set default values for plugin", function () {

        browser.get('/wp-admin/options-general.php?page=atyfp-plugin-options');
        browser.sleep( 2000 );

        //expect(element('input[name="atyfp-options[atyfp-image]"]:checked').val()).toBe('parttime');

        if(element(by.id('atyfp-only-registered-users')).isSelected())
            element(by.id('atyfp-only-registered-users')).click();
        element(by.css('input[value="single"]')).click();
        element(by.css('input[value="heart"]')).click();
        element(by.id('submit')).click();
        browser.sleep( 2000 );

        expect(element(by.css("#setting-error-settings_updated")).getText()).toBe('Settings saved.');

        element(by.css('input[value="counter"]')).click();
        element(by.css('input[value="star"]')).click();
        element(by.id('atyfp-only-registered-users')).click();
        element(by.id('submit')).click();
        browser.sleep( 2000 );

        expect(element(by.css("#setting-error-settings_updated")).getText()).toBe('Settings saved.');

        expect(element(by.css('input[value="counter"]')).isSelected()).toBeTruthy();
        expect(element(by.css('input[value="star"]')).isSelected()).toBeTruthy();
        expect(element(by.id('atyfp-only-registered-users')).isSelected()).toBeTruthy();

    });

    function login_steps() {
        browser.get('/wp-login');

        element(by.id('user_login')).clear();

        element(by.id('user_login')).sendKeys('maronl_admin');

        element(by.id('user_pass')).clear();

        element(by.id('user_pass')).sendKeys('maronl');

        element(by.id('wp-submit')).click();
        browser.sleep( 2000 );
    }

    function logout_steps() {
        browser.get('/wp-admin');
        browser.sleep( 2000 );

        browser.actions().mouseMove(element(by.id('wp-admin-bar-my-account'))).perform();
        browser.sleep( 2000 );

        element(by.id('wp-admin-bar-logout')).click();
        browser.sleep( 2000 );
    }

});
