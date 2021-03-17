# InstagramAPI
Instagram Basic Display API module for Processwire.

## Requirements
* ProcessWire >= 5.6
* A Facebook Developer account
* Access to an Instagram user account

## Creating a Facebook App

These instructions will assist you in creating a Facebook App for the Instagram Basic Display API.

The app you will create uses the [*User Token Generator*](https://developers.facebook.com/docs/instagram-basic-display-api/overview#user-token-generator) for authentication - it does not need to be submitted for App Review. However, this does mean that you need to be able to login to the Instagram account for approval. If setting up for a client, suggest arranging a time when they can change the password temporarily to allow you to access the account and authenticate the app.

### Create a New Facebook App
1. Login to your account at [https://developers.facebook.com/](https://developers.facebook.com/).
2. *My Apps > Create App*.
3. Give your app a *Display Name*. This cannot contain certain reserved words such as `Instagram`, `IG`, `Insta` or `Facebook`. I recommend using something like `Image Feed - ProcessWire Website`.
4. Add a *Contact Email* if not already populated.
5. Click **Create App ID** and complete the Security Check if required.
6. You will be prompted to *Add a Product*. Find *Instagram* and click **Set Up**.

### Configure the Facebook App
You should now see *Instagram* listed in *Products* in the left sidebar. Before continuing with the Basic Display setup, you need to configure the app itself.

#### Settings > Basic
1. Scroll to the bottom of this page and click **Add Platform**.
2. Select **Website**.
3. Enter the URL of the site the module will be used on. If you intend to use this module on multiple sites, use your company's own website.
4. **Save Changes**

You can add any other information to this screen that you wish, such as an *App Icon*.

#### Settings > Advanced (Optional)
1. *Security > Server IP Whitelist* - Whitelist any server IPs here.
2. *Business Manager* - If you have a Business Manager account, select it here to assign ownership of the app.

### Basic Display Configuration
Now your Facebook app is ready, you can configure it to access the Instagram Basic Display API.

#### Create an Instagram Basic Display App
*Instagram > Basic Display*, click **Create New App** then **Create App**.

Even though this module does not use OAuth for authentication, the app still requires some settings:
* *Client OAuth Settings* - Add `https://{your-website.com}/{your-admin-url}/InstagramBasicDisplayApi` as a *Valid OAuth Redirect URI*.
* *Deauthorize Callback URL* - Set this to `https://{your-website.com}/{your-admin-url}/InstagramBasicDisplayApi?action=deauthorize`.
* *Data Deletion Request URL* - Set this to `https://{your-website.com}/{your-admin-url}/InstagramBasicDisplayApi?action=delete`.

The Redirect URI should never be called by the API. However, if a user does deauthorize your app, or request deletion, the module is setup to handle these requests and notify you, so it makes sense to set actual URLs here.

#### Add the Instagram user account
1. *Roles > Instagram Testers*.
2. Click **Add Instagram Testers**.
3. Enter the username of the account to be added and click it when it appears.
4. Click **Submit**.
5. Login to the Instagram Account through [instagram.com](https://instagram.com/).
6. *Settings > Apps and Websites*. On the website, click the username to go to the profile, then click the "cog" icon.
7. Click on **Tester Invites** then click **Accept** for the app you have created.
8. Back in the App Dashboard, go to *Instagram > Basic Display > User Token Generator*.
9. You should now see the user account here. Click on **Generate Token**.
10. Log in to the Instagram Account again if necessary or click the continue button.
11. **Authorize** the app.
12. Check *I Understand* then copy the token that has been generated. Save it somewhere as you will need it to configure the module.

These instructions were current as of March 2020. If you notice any changes to how the Facebook Developer platform operates, please let me know on the [Support Forum](https://processwire.com/talk/topic/23028-instagrambasicdisplayapi/).

## Module Configuration
After you have installed this module:
1. *Modules > Configure > InstagramBasicDisplayApi*.
2. Add the username and generated token to *Add an Instagram User Account*.
3. Click **Submit**.
4. If successful, you should now see the account information in *Authorized Accounts*.

You can add as many accounts as you wish, as long as they have a token generated in your app.

The access token will be renewed automatically within the week prior to expiry.