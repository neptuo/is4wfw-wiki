<controls:auth />

<web:condition when="var:ajax">
    <web:flush template="none" contentType="text/json" />
    <router:render />
</web:condition>
<web:condition when="var:ajax" isInverted="true">
    <web:doctype type="html5" />
    <web:head>
        <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no,shrink-to-fit=no" />
        
        <style>
            .main-navbar .navbar-toggler {
                border: none;
                outline: none;
            }
        </style>
    
        <web:out if:stringEmpty="var:wiki.icon.id" if:not="true">
            <img:favicon fileId="var:wiki.icon.id" />
        </web:out>

        <bs:resources />
        <fa5:resources />
    </web:head>
    
    <controls:navbar />

    <bs:container class="my-4">
        <var:use name="message" scope="temp" />
        <web:condition when="var:message">
            <bs:alert color="primary" class="mb-4">
                <web:out text="var:message" />
            </bs:alert>
        </web:condition>

        <!-- if:false can't be used here -->
        <web:condition when="router:hasMatch" isInverted="true">
            Not Found 
        </web:condition>
        <router:render />
    </bs:container>
</web:condition>