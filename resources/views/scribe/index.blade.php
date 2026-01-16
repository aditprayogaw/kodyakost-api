<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Laravel API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://localhost";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.6.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.6.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-endpoints" class="tocify-header">
                <li class="tocify-item level-1" data-unique="endpoints">
                    <a href="#endpoints">Endpoints</a>
                </li>
                                    <ul id="tocify-subheader-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="endpoints-POSTapi-register">
                                <a href="#endpoints-POSTapi-register">POST api/register</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-login">
                                <a href="#endpoints-POSTapi-login">POST api/login</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-kosts">
                                <a href="#endpoints-GETapi-kosts">GET api/kosts</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-kosts--id-">
                                <a href="#endpoints-GETapi-kosts--id-">GET api/kosts/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-facilities">
                                <a href="#endpoints-GETapi-facilities">GET api/facilities</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-cultural-events">
                                <a href="#endpoints-GETapi-cultural-events">GET api/cultural-events</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-kosts--id--reviews">
                                <a href="#endpoints-GETapi-kosts--id--reviews">GET api/kosts/{id}/reviews</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-user">
                                <a href="#endpoints-GETapi-user">GET api/user</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-dashboard">
                                <a href="#endpoints-GETapi-dashboard">GET api/dashboard</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-wishlists">
                                <a href="#endpoints-GETapi-wishlists">GET api/wishlists</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-wishlists-toggle">
                                <a href="#endpoints-POSTapi-wishlists-toggle">POST api/wishlists/toggle</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-reviews">
                                <a href="#endpoints-POSTapi-reviews">POST api/reviews</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-mock-cultural-events">
                                <a href="#endpoints-GETapi-mock-cultural-events">GET api/mock-cultural-events</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: January 16, 2026</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<aside>
    <strong>Base URL</strong>: <code>http://localhost</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>This API is not authenticated.</p>

        <h1 id="endpoints">Endpoints</h1>

    

                                <h2 id="endpoints-POSTapi-register">POST api/register</h2>

<p>
</p>



<span id="example-requests-POSTapi-register">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/register" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"b\",
    \"email\": \"zbailey@example.net\",
    \"password\": \"-0pBNvYgxw\",
    \"role\": \"owner\",
    \"phone_whatsapp\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/register"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "b",
    "email": "zbailey@example.net",
    "password": "-0pBNvYgxw",
    "role": "owner",
    "phone_whatsapp": "architecto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-register">
</span>
<span id="execution-results-POSTapi-register" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-register"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-register"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-register" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-register">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-register" data-method="POST"
      data-path="api/register"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-register', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-register"
                    onclick="tryItOut('POSTapi-register');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-register"
                    onclick="cancelTryOut('POSTapi-register');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-register"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/register</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-register"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-register"
               value="zbailey@example.net"
               data-component="body">
    <br>
<p>Must be a valid email address. Must not be greater than 255 characters. Example: <code>zbailey@example.net</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-register"
               value="-0pBNvYgxw"
               data-component="body">
    <br>
<p>Must be at least 8 characters. Example: <code>-0pBNvYgxw</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>role</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="role"                data-endpoint="POSTapi-register"
               value="owner"
               data-component="body">
    <br>
<p>Example: <code>owner</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>tenant</code></li> <li><code>owner</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone_whatsapp</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone_whatsapp"                data-endpoint="POSTapi-register"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-login">POST api/login</h2>

<p>
</p>



<span id="example-requests-POSTapi-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-login">
</span>
<span id="execution-results-POSTapi-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-login"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-login">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-login" data-method="POST"
      data-path="api/login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-login"
                    onclick="tryItOut('POSTapi-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-login"
                    onclick="cancelTryOut('POSTapi-login');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-login"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-kosts">GET api/kosts</h2>

<p>
</p>



<span id="example-requests-GETapi-kosts">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/kosts" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/kosts"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-kosts">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;D&#039;Panjer Residence&quot;,
            &quot;description&quot;: &quot;Kos eksklusif dekat kampus UNUD Sudirman.&quot;,
            &quot;location&quot;: {
                &quot;address&quot;: &quot;Jl. Tukad Pakerisan No. 99&quot;,
                &quot;district&quot;: &quot;Denpasar Selatan&quot;,
                &quot;village&quot;: &quot;Panjer&quot;,
                &quot;latitude&quot;: -8.675,
                &quot;longitude&quot;: 115.234
            },
            &quot;is_verified&quot;: true,
            &quot;owner&quot;: {
                &quot;name&quot;: &quot;Krisna Owner&quot;,
                &quot;whatsapp&quot;: &quot;628123456789&quot;
            },
            &quot;thumbnail&quot;: &quot;https://i.pinimg.com/736x/20/6e/e8/206ee8503c87ee66394c1eae81d56885.jpg&quot;,
            &quot;price_start&quot;: 2000000,
            &quot;rooms&quot;: [
                {
                    &quot;type&quot;: &quot;VIP&quot;,
                    &quot;gallery&quot;: [
                        &quot;https://i.pinimg.com/736x/58/bf/af/58bfafa0ad1588e72bd3367254737960.jpg&quot;,
                        &quot;https://i.pinimg.com/1200x/af/6c/53/af6c53270ec27e3892cbfad02c961ebf.jpg&quot;,
                        &quot;https://i.pinimg.com/736x/1c/60/ca/1c60ca5c8b0cf0e6b58d07e4f8d742fa.jpg&quot;
                    ],
                    &quot;price&quot;: 2000000,
                    &quot;available&quot;: 3,
                    &quot;is_room_available&quot;: true,
                    &quot;size&quot;: &quot;4x4&quot;,
                    &quot;facilities&quot;: [
                        {
                            &quot;name&quot;: &quot;AC&quot;,
                            &quot;icon&quot;: &quot;ac-icon&quot;
                        },
                        {
                            &quot;name&quot;: &quot;WiFi&quot;,
                            &quot;icon&quot;: &quot;wifi-icon&quot;
                        },
                        {
                            &quot;name&quot;: &quot;Kamar Mandi Dalam&quot;,
                            &quot;icon&quot;: &quot;bathroom-icon&quot;
                        }
                    ]
                }
            ]
        },
        {
            &quot;id&quot;: 2,
            &quot;name&quot;: &quot;Renon Garden Kost&quot;,
            &quot;description&quot;: &quot;Lingkungan tenang, dekat dengan Lapangan Niti Mandala.&quot;,
            &quot;location&quot;: {
                &quot;address&quot;: &quot;Jl. Raya Puputan Gang IV&quot;,
                &quot;district&quot;: &quot;Denpasar Timur&quot;,
                &quot;village&quot;: &quot;Sumerta Kelod&quot;,
                &quot;latitude&quot;: -8.67,
                &quot;longitude&quot;: 115.245
            },
            &quot;is_verified&quot;: true,
            &quot;owner&quot;: {
                &quot;name&quot;: &quot;Krisna Owner&quot;,
                &quot;whatsapp&quot;: &quot;628123456789&quot;
            },
            &quot;thumbnail&quot;: &quot;https://i.pinimg.com/736x/6f/66/f7/6f66f782f4b4fb3fab18ce2f6d3e3857.jpg&quot;,
            &quot;price_start&quot;: 1200000,
            &quot;rooms&quot;: [
                {
                    &quot;type&quot;: &quot;Standard&quot;,
                    &quot;gallery&quot;: [
                        &quot;https://i.pinimg.com/736x/58/bf/af/58bfafa0ad1588e72bd3367254737960.jpg&quot;,
                        &quot;https://i.pinimg.com/1200x/af/6c/53/af6c53270ec27e3892cbfad02c961ebf.jpg&quot;,
                        &quot;https://i.pinimg.com/736x/1c/60/ca/1c60ca5c8b0cf0e6b58d07e4f8d742fa.jpg&quot;
                    ],
                    &quot;price&quot;: 1200000,
                    &quot;available&quot;: 5,
                    &quot;is_room_available&quot;: true,
                    &quot;size&quot;: &quot;3x3&quot;,
                    &quot;facilities&quot;: [
                        {
                            &quot;name&quot;: &quot;WiFi&quot;,
                            &quot;icon&quot;: &quot;wifi-icon&quot;
                        },
                        {
                            &quot;name&quot;: &quot;Lemari&quot;,
                            &quot;icon&quot;: &quot;wardrobe-icon&quot;
                        },
                        {
                            &quot;name&quot;: &quot;Meja Belajar&quot;,
                            &quot;icon&quot;: &quot;desk-icon&quot;
                        }
                    ]
                }
            ]
        },
        {
            &quot;id&quot;: 3,
            &quot;name&quot;: &quot;Teuku Umar Stay&quot;,
            &quot;description&quot;: &quot;Akses mudah ke pusat perbelanjaan dan kuliner.&quot;,
            &quot;location&quot;: {
                &quot;address&quot;: &quot;Jl. Teuku Umar No. 10&quot;,
                &quot;district&quot;: &quot;Denpasar Barat&quot;,
                &quot;village&quot;: &quot;Dauh Puri&quot;,
                &quot;latitude&quot;: -8.678,
                &quot;longitude&quot;: 115.21
            },
            &quot;is_verified&quot;: true,
            &quot;owner&quot;: {
                &quot;name&quot;: &quot;Krisna Owner&quot;,
                &quot;whatsapp&quot;: &quot;628123456789&quot;
            },
            &quot;thumbnail&quot;: &quot;https://i.pinimg.com/736x/20/6e/e8/206ee8503c87ee66394c1eae81d56885.jpg&quot;,
            &quot;price_start&quot;: 1500000,
            &quot;rooms&quot;: [
                {
                    &quot;type&quot;: &quot;Standard AC&quot;,
                    &quot;gallery&quot;: [
                        &quot;https://i.pinimg.com/736x/58/bf/af/58bfafa0ad1588e72bd3367254737960.jpg&quot;,
                        &quot;https://i.pinimg.com/1200x/af/6c/53/af6c53270ec27e3892cbfad02c961ebf.jpg&quot;,
                        &quot;https://i.pinimg.com/736x/1c/60/ca/1c60ca5c8b0cf0e6b58d07e4f8d742fa.jpg&quot;
                    ],
                    &quot;price&quot;: 1500000,
                    &quot;available&quot;: 0,
                    &quot;is_room_available&quot;: false,
                    &quot;size&quot;: &quot;3x4&quot;,
                    &quot;facilities&quot;: [
                        {
                            &quot;name&quot;: &quot;AC&quot;,
                            &quot;icon&quot;: &quot;ac-icon&quot;
                        },
                        {
                            &quot;name&quot;: &quot;WiFi&quot;,
                            &quot;icon&quot;: &quot;wifi-icon&quot;
                        },
                        {
                            &quot;name&quot;: &quot;Laundry&quot;,
                            &quot;icon&quot;: &quot;laundry-icon&quot;
                        }
                    ]
                }
            ]
        },
        {
            &quot;id&quot;: 4,
            &quot;name&quot;: &quot;Padangsambian Cozy Kost&quot;,
            &quot;description&quot;: &quot;Dekat dengan kampus ISI dan fasilitas umum.&quot;,
            &quot;location&quot;: {
                &quot;address&quot;: &quot;Jl. Padangsambian Kangin No. 45&quot;,
                &quot;district&quot;: &quot;Denpasar Utara&quot;,
                &quot;village&quot;: &quot;Padangsambian&quot;,
                &quot;latitude&quot;: -8.65,
                &quot;longitude&quot;: 115.22
            },
            &quot;is_verified&quot;: true,
            &quot;owner&quot;: {
                &quot;name&quot;: &quot;Krisna Owner&quot;,
                &quot;whatsapp&quot;: &quot;628123456789&quot;
            },
            &quot;thumbnail&quot;: &quot;https://i.pinimg.com/736x/6f/66/f7/6f66f782f4b4fb3fab18ce2f6d3e3857.jpg&quot;,
            &quot;price_start&quot;: 1800000,
            &quot;rooms&quot;: [
                {
                    &quot;type&quot;: &quot;Deluxe&quot;,
                    &quot;gallery&quot;: [
                        &quot;https://i.pinimg.com/736x/58/bf/af/58bfafa0ad1588e72bd3367254737960.jpg&quot;,
                        &quot;https://i.pinimg.com/1200x/af/6c/53/af6c53270ec27e3892cbfad02c961ebf.jpg&quot;,
                        &quot;https://i.pinimg.com/736x/1c/60/ca/1c60ca5c8b0cf0e6b58d07e4f8d742fa.jpg&quot;
                    ],
                    &quot;price&quot;: 1800000,
                    &quot;available&quot;: 4,
                    &quot;is_room_available&quot;: true,
                    &quot;size&quot;: &quot;4x3&quot;,
                    &quot;facilities&quot;: [
                        {
                            &quot;name&quot;: &quot;AC&quot;,
                            &quot;icon&quot;: &quot;ac-icon&quot;
                        },
                        {
                            &quot;name&quot;: &quot;Dapur&quot;,
                            &quot;icon&quot;: &quot;kitchen-icon&quot;
                        },
                        {
                            &quot;name&quot;: &quot;Parkir&quot;,
                            &quot;icon&quot;: &quot;parking-icon&quot;
                        }
                    ]
                }
            ]
        },
        {
            &quot;id&quot;: 5,
            &quot;name&quot;: &quot;Sanur Beach Kost&quot;,
            &quot;description&quot;: &quot;Suasana pantai yang menenangkan, cocok untuk mahasiswa.&quot;,
            &quot;location&quot;: {
                &quot;address&quot;: &quot;Jl. Danau Tamblingan No. 88&quot;,
                &quot;district&quot;: &quot;Denpasar Selatan&quot;,
                &quot;village&quot;: &quot;Sanur&quot;,
                &quot;latitude&quot;: -8.68,
                &quot;longitude&quot;: 115.25
            },
            &quot;is_verified&quot;: true,
            &quot;owner&quot;: {
                &quot;name&quot;: &quot;Krisna Owner&quot;,
                &quot;whatsapp&quot;: &quot;628123456789&quot;
            },
            &quot;thumbnail&quot;: &quot;https://i.pinimg.com/736x/20/6e/e8/206ee8503c87ee66394c1eae81d56885.jpg&quot;,
            &quot;price_start&quot;: 1000000,
            &quot;rooms&quot;: [
                {
                    &quot;type&quot;: &quot;Standard&quot;,
                    &quot;gallery&quot;: [
                        &quot;https://i.pinimg.com/736x/58/bf/af/58bfafa0ad1588e72bd3367254737960.jpg&quot;,
                        &quot;https://i.pinimg.com/1200x/af/6c/53/af6c53270ec27e3892cbfad02c961ebf.jpg&quot;,
                        &quot;https://i.pinimg.com/736x/1c/60/ca/1c60ca5c8b0cf0e6b58d07e4f8d742fa.jpg&quot;
                    ],
                    &quot;price&quot;: 1000000,
                    &quot;available&quot;: 10,
                    &quot;is_room_available&quot;: true,
                    &quot;size&quot;: &quot;3x3&quot;,
                    &quot;facilities&quot;: [
                        {
                            &quot;name&quot;: &quot;WiFi&quot;,
                            &quot;icon&quot;: &quot;wifi-icon&quot;
                        },
                        {
                            &quot;name&quot;: &quot;Kamar Mandi Dalam&quot;,
                            &quot;icon&quot;: &quot;bathroom-icon&quot;
                        },
                        {
                            &quot;name&quot;: &quot;Meja Belajar&quot;,
                            &quot;icon&quot;: &quot;desk-icon&quot;
                        }
                    ]
                }
            ]
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-kosts" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-kosts"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-kosts"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-kosts" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-kosts">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-kosts" data-method="GET"
      data-path="api/kosts"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-kosts', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-kosts"
                    onclick="tryItOut('GETapi-kosts');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-kosts"
                    onclick="cancelTryOut('GETapi-kosts');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-kosts"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/kosts</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-kosts"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-kosts"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-kosts--id-">GET api/kosts/{id}</h2>

<p>
</p>



<span id="example-requests-GETapi-kosts--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/kosts/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/kosts/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-kosts--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;D&#039;Panjer Residence&quot;,
        &quot;description&quot;: &quot;Kos eksklusif dekat kampus UNUD Sudirman.&quot;,
        &quot;location&quot;: {
            &quot;address&quot;: &quot;Jl. Tukad Pakerisan No. 99&quot;,
            &quot;district&quot;: &quot;Denpasar Selatan&quot;,
            &quot;village&quot;: &quot;Panjer&quot;,
            &quot;latitude&quot;: -8.675,
            &quot;longitude&quot;: 115.234
        },
        &quot;is_verified&quot;: true,
        &quot;owner&quot;: {
            &quot;name&quot;: &quot;Krisna Owner&quot;,
            &quot;whatsapp&quot;: &quot;628123456789&quot;
        },
        &quot;thumbnail&quot;: &quot;https://i.pinimg.com/736x/20/6e/e8/206ee8503c87ee66394c1eae81d56885.jpg&quot;,
        &quot;price_start&quot;: 2000000,
        &quot;rooms&quot;: [
            {
                &quot;type&quot;: &quot;VIP&quot;,
                &quot;gallery&quot;: [
                    &quot;https://i.pinimg.com/736x/58/bf/af/58bfafa0ad1588e72bd3367254737960.jpg&quot;,
                    &quot;https://i.pinimg.com/1200x/af/6c/53/af6c53270ec27e3892cbfad02c961ebf.jpg&quot;,
                    &quot;https://i.pinimg.com/736x/1c/60/ca/1c60ca5c8b0cf0e6b58d07e4f8d742fa.jpg&quot;
                ],
                &quot;price&quot;: 2000000,
                &quot;available&quot;: 3,
                &quot;is_room_available&quot;: true,
                &quot;size&quot;: &quot;4x4&quot;,
                &quot;facilities&quot;: [
                    {
                        &quot;name&quot;: &quot;AC&quot;,
                        &quot;icon&quot;: &quot;ac-icon&quot;
                    },
                    {
                        &quot;name&quot;: &quot;WiFi&quot;,
                        &quot;icon&quot;: &quot;wifi-icon&quot;
                    },
                    {
                        &quot;name&quot;: &quot;Kamar Mandi Dalam&quot;,
                        &quot;icon&quot;: &quot;bathroom-icon&quot;
                    }
                ]
            }
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-kosts--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-kosts--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-kosts--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-kosts--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-kosts--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-kosts--id-" data-method="GET"
      data-path="api/kosts/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-kosts--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-kosts--id-"
                    onclick="tryItOut('GETapi-kosts--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-kosts--id-"
                    onclick="cancelTryOut('GETapi-kosts--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-kosts--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/kosts/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-kosts--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-kosts--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-kosts--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the kost. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-facilities">GET api/facilities</h2>

<p>
</p>



<span id="example-requests-GETapi-facilities">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/facilities" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/facilities"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-facilities">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;AC&quot;,
            &quot;icon&quot;: &quot;ac-icon&quot;,
            &quot;created_at&quot;: &quot;2026-01-15T01:44:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-15T01:44:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 2,
            &quot;name&quot;: &quot;WiFi&quot;,
            &quot;icon&quot;: &quot;wifi-icon&quot;,
            &quot;created_at&quot;: &quot;2026-01-15T01:44:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-15T01:44:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 3,
            &quot;name&quot;: &quot;Kamar Mandi Dalam&quot;,
            &quot;icon&quot;: &quot;bathroom-icon&quot;,
            &quot;created_at&quot;: &quot;2026-01-15T01:44:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-15T01:44:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 4,
            &quot;name&quot;: &quot;Dapur&quot;,
            &quot;icon&quot;: &quot;kitchen-icon&quot;,
            &quot;created_at&quot;: &quot;2026-01-15T01:44:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-15T01:44:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 5,
            &quot;name&quot;: &quot;Parkir&quot;,
            &quot;icon&quot;: &quot;parking-icon&quot;,
            &quot;created_at&quot;: &quot;2026-01-15T01:44:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-15T01:44:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 6,
            &quot;name&quot;: &quot;Laundry&quot;,
            &quot;icon&quot;: &quot;laundry-icon&quot;,
            &quot;created_at&quot;: &quot;2026-01-15T01:44:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-15T01:44:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 7,
            &quot;name&quot;: &quot;Lemari&quot;,
            &quot;icon&quot;: &quot;wardrobe-icon&quot;,
            &quot;created_at&quot;: &quot;2026-01-15T01:44:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-15T01:44:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 8,
            &quot;name&quot;: &quot;Meja Belajar&quot;,
            &quot;icon&quot;: &quot;desk-icon&quot;,
            &quot;created_at&quot;: &quot;2026-01-15T01:44:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-15T01:44:38.000000Z&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-facilities" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-facilities"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-facilities"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-facilities" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-facilities">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-facilities" data-method="GET"
      data-path="api/facilities"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-facilities', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-facilities"
                    onclick="tryItOut('GETapi-facilities');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-facilities"
                    onclick="cancelTryOut('GETapi-facilities');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-facilities"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/facilities</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-facilities"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-facilities"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-cultural-events">GET api/cultural-events</h2>

<p>
</p>



<span id="example-requests-GETapi-cultural-events">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/cultural-events" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/cultural-events"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-cultural-events">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;event_name&quot;: &quot;Pawai Ogoh-ogoh (Pengerupukan)&quot;,
            &quot;event_type&quot;: &quot;pawai&quot;,
            &quot;description&quot;: &quot;Penutupan jalan total di sekitar Catur Muka.&quot;,
            &quot;latitude&quot;: &quot;-8.67012345&quot;,
            &quot;longitude&quot;: &quot;115.21234567&quot;,
            &quot;severity&quot;: &quot;high&quot;,
            &quot;event_date&quot;: &quot;2026-03-20&quot;,
            &quot;created_at&quot;: &quot;2026-01-15T01:44:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-15T01:44:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 2,
            &quot;event_name&quot;: &quot;Upacara Melasti di Pantai Sanur&quot;,
            &quot;event_type&quot;: &quot;upacara_adat&quot;,
            &quot;description&quot;: &quot;Penutupan jalan menuju Pantai Sanur selama upacara berlangsung.&quot;,
            &quot;latitude&quot;: &quot;-8.68812345&quot;,
            &quot;longitude&quot;: &quot;115.25876543&quot;,
            &quot;severity&quot;: &quot;low&quot;,
            &quot;event_date&quot;: &quot;2026-04-10&quot;,
            &quot;created_at&quot;: &quot;2026-01-15T01:44:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-15T01:44:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 3,
            &quot;event_name&quot;: &quot;Penutupan Jalan untuk Perayaan Hari Raya Galungan&quot;,
            &quot;event_type&quot;: &quot;penutupan_jalan&quot;,
            &quot;description&quot;: &quot;Penutupan jalan utama di Denpasar untuk perayaan Galungan.&quot;,
            &quot;latitude&quot;: &quot;-8.65543210&quot;,
            &quot;longitude&quot;: &quot;115.22012345&quot;,
            &quot;severity&quot;: &quot;high&quot;,
            &quot;event_date&quot;: &quot;2026-06-01&quot;,
            &quot;created_at&quot;: &quot;2026-01-15T01:44:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-15T01:44:38.000000Z&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-cultural-events" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-cultural-events"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-cultural-events"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-cultural-events" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-cultural-events">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-cultural-events" data-method="GET"
      data-path="api/cultural-events"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-cultural-events', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-cultural-events"
                    onclick="tryItOut('GETapi-cultural-events');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-cultural-events"
                    onclick="cancelTryOut('GETapi-cultural-events');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-cultural-events"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/cultural-events</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-cultural-events"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-cultural-events"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-kosts--id--reviews">GET api/kosts/{id}/reviews</h2>

<p>
</p>



<span id="example-requests-GETapi-kosts--id--reviews">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/kosts/1/reviews" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/kosts/1/reviews"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-kosts--id--reviews">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;user_id&quot;: 8,
            &quot;kost_id&quot;: 1,
            &quot;rating&quot;: 5,
            &quot;comment&quot;: &quot;Kosnya bersih banget, ibu kos ramah. Recommended!&quot;,
            &quot;created_at&quot;: &quot;2026-01-16T01:38:42.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-16T01:38:42.000000Z&quot;,
            &quot;user&quot;: {
                &quot;id&quot;: 8,
                &quot;name&quot;: &quot;Made Owner&quot;,
                &quot;avatar&quot;: null
            }
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-kosts--id--reviews" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-kosts--id--reviews"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-kosts--id--reviews"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-kosts--id--reviews" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-kosts--id--reviews">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-kosts--id--reviews" data-method="GET"
      data-path="api/kosts/{id}/reviews"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-kosts--id--reviews', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-kosts--id--reviews"
                    onclick="tryItOut('GETapi-kosts--id--reviews');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-kosts--id--reviews"
                    onclick="cancelTryOut('GETapi-kosts--id--reviews');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-kosts--id--reviews"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/kosts/{id}/reviews</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-kosts--id--reviews"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-kosts--id--reviews"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-kosts--id--reviews"
               value="1"
               data-component="url">
    <br>
<p>The ID of the kost. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-user">GET api/user</h2>

<p>
</p>



<span id="example-requests-GETapi-user">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/user" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/user"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-user">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-user" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-user"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-user"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-user" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-user">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-user" data-method="GET"
      data-path="api/user"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-user', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-user"
                    onclick="tryItOut('GETapi-user');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-user"
                    onclick="cancelTryOut('GETapi-user');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-user"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/user</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-dashboard">GET api/dashboard</h2>

<p>
</p>



<span id="example-requests-GETapi-dashboard">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/dashboard" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/dashboard"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-dashboard">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-dashboard" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-dashboard"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-dashboard"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-dashboard" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-dashboard">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-dashboard" data-method="GET"
      data-path="api/dashboard"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-dashboard', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-dashboard"
                    onclick="tryItOut('GETapi-dashboard');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-dashboard"
                    onclick="cancelTryOut('GETapi-dashboard');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-dashboard"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/dashboard</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-dashboard"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-dashboard"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-wishlists">GET api/wishlists</h2>

<p>
</p>



<span id="example-requests-GETapi-wishlists">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/wishlists" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/wishlists"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-wishlists">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-wishlists" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-wishlists"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-wishlists"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-wishlists" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-wishlists">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-wishlists" data-method="GET"
      data-path="api/wishlists"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-wishlists', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-wishlists"
                    onclick="tryItOut('GETapi-wishlists');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-wishlists"
                    onclick="cancelTryOut('GETapi-wishlists');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-wishlists"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/wishlists</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-wishlists"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-wishlists"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-wishlists-toggle">POST api/wishlists/toggle</h2>

<p>
</p>



<span id="example-requests-POSTapi-wishlists-toggle">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/wishlists/toggle" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"kost_id\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/wishlists/toggle"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "kost_id": "architecto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-wishlists-toggle">
</span>
<span id="execution-results-POSTapi-wishlists-toggle" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-wishlists-toggle"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-wishlists-toggle"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-wishlists-toggle" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-wishlists-toggle">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-wishlists-toggle" data-method="POST"
      data-path="api/wishlists/toggle"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-wishlists-toggle', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-wishlists-toggle"
                    onclick="tryItOut('POSTapi-wishlists-toggle');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-wishlists-toggle"
                    onclick="cancelTryOut('POSTapi-wishlists-toggle');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-wishlists-toggle"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/wishlists/toggle</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-wishlists-toggle"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-wishlists-toggle"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>kost_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="kost_id"                data-endpoint="POSTapi-wishlists-toggle"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the kosts table. Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-reviews">POST api/reviews</h2>

<p>
</p>



<span id="example-requests-POSTapi-reviews">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/reviews" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"kost_id\": \"architecto\",
    \"rating\": 2,
    \"comment\": \"g\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/reviews"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "kost_id": "architecto",
    "rating": 2,
    "comment": "g"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-reviews">
</span>
<span id="execution-results-POSTapi-reviews" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-reviews"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-reviews"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-reviews" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-reviews">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-reviews" data-method="POST"
      data-path="api/reviews"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-reviews', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-reviews"
                    onclick="tryItOut('POSTapi-reviews');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-reviews"
                    onclick="cancelTryOut('POSTapi-reviews');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-reviews"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/reviews</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-reviews"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-reviews"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>kost_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="kost_id"                data-endpoint="POSTapi-reviews"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the kosts table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>rating</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="rating"                data-endpoint="POSTapi-reviews"
               value="2"
               data-component="body">
    <br>
<p>Must be at least 1. Must not be greater than 5. Example: <code>2</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>comment</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="comment"                data-endpoint="POSTapi-reviews"
               value="g"
               data-component="body">
    <br>
<p>Bintang 1 sampai 5. Must not be greater than 500 characters. Example: <code>g</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-mock-cultural-events">GET api/mock-cultural-events</h2>

<p>
</p>



<span id="example-requests-GETapi-mock-cultural-events">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/mock-cultural-events" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/mock-cultural-events"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-mock-cultural-events">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Data Event Budaya &amp; Kemacetan Denpasar (Simulation)&quot;,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 101,
            &quot;event_name&quot;: &quot;Pawai Ogoh-ogoh (Pengerupukan)&quot;,
            &quot;description&quot;: &quot;Penutupan jalan total di sekitar Catur Muka.&quot;,
            &quot;district&quot;: &quot;Denpasar Utara&quot;,
            &quot;latitude&quot;: -8.6581,
            &quot;longitude&quot;: 115.2163,
            &quot;type&quot;: &quot;road_closure&quot;,
            &quot;severity&quot;: &quot;high&quot;
        },
        {
            &quot;id&quot;: 102,
            &quot;event_name&quot;: &quot;Upacara Melasti&quot;,
            &quot;description&quot;: &quot;Iring-iringan menuju Pantai Sanur. Bypass Ngurah Rai padat.&quot;,
            &quot;district&quot;: &quot;Denpasar Selatan&quot;,
            &quot;latitude&quot;: -8.6748,
            &quot;longitude&quot;: 115.2631,
            &quot;type&quot;: &quot;traffic_warning&quot;,
            &quot;severity&quot;: &quot;medium&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-mock-cultural-events" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-mock-cultural-events"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-mock-cultural-events"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-mock-cultural-events" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-mock-cultural-events">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-mock-cultural-events" data-method="GET"
      data-path="api/mock-cultural-events"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-mock-cultural-events', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-mock-cultural-events"
                    onclick="tryItOut('GETapi-mock-cultural-events');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-mock-cultural-events"
                    onclick="cancelTryOut('GETapi-mock-cultural-events');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-mock-cultural-events"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/mock-cultural-events</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-mock-cultural-events"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-mock-cultural-events"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
