<module:use id="var:moduleId">
    <php:lazy cepage="php.libs.CustomEntity" />
    <php:attribute prefix="cepage" tag="*" name="name" value="page" />
    <php:lazy cehistory="php.libs.CustomEntity" />
    <php:attribute prefix="cehistory" tag="*" name="name" value="pagehistory" />
    <php:lazy cefolder="php.libs.CustomEntity" />
    <php:attribute prefix="cefolder" tag="*" name="name" value="folder" />

    <var:use name="favorites" scope="user" />

    <login:init group="wiki" cookieName="wiki" />
    <web:doctype type="html5" />
    <web:head>
        <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no,shrink-to-fit=no" />
        <style>
            .main-navbar .navbar-toggler {
                border: none;
                outline: none;
            }
        </style>
    </web:head>
    <bs:resources />
    <fa5:resources />

    <template:declare identifier="title">
        <utils:concat output="pageTitle" value1="template:value" value2=" - " value3="var:brand" />
        <web:setProperty prefix="web" name="pageTitle" value="utils:pageTitle" />
    </template:declare>

    <filter:declare name="pageWithoutFolder">
        <filter:null name="folder_id" />
    </filter:declare>
    <cepage:urlResolver propertyName="url" columnName="url" filter="filter:pageWithoutFolder" />

    <cefolder:urlResolver propertyName="url" columnName="url" />
    <cehistory:urlResolver propertyName="created_date" columnName="created_date" />

    <router:fromPath path="var:relativeUrl">
        <router:file path="" name="home">
            <template:title value="Home" />
            <pages:home />
        </router:file>
        <router:file path="login" name="login">
            <template:title value="Login" />
            <pages:login />
        </router:file>
        <router:file path="all" name="all">
            <template:title value="All pages" />

            <controls:pageListGrouped />
        </router:file>
        <router:file path="archive" name="archive">
            <template:title value="Archive" />
            <pages:archive />
        </router:file>
        <router:file path="favorites" name="favorites">
            <template:title value="Your favorites" />
            <controls:pageListGrouped>
                <filter:in name="id" values="var:favorites" />
            </controls:pageListGrouped>
        </router:file>
        <router:file path="settings" name="settings">
            <template:title value="Settings" />
            <pages:settings />
        </router:file>
        <router:file path="profile" name="profile">
            <template:title value="Profile" />
            <pages:profile />
        </router:file>
        <router:file path="about" name="about">
            <template:title value="About" />
            <pages:about />
        </router:file>
        <router:file name="new" path="new">
            <login:authorized any="wiki">
                <pages:edit />
            </login:authorized>
        </router:file>
        <router:directory path="folders">
            <router:file path="" name="folderList">
                <login:authorized any="wiki">
                    <template:title value="Folders" />
                    <pages:folderList />
                </login:authorized>
            </router:file>
            <router:file path="new" name="folderNew">
                <login:authorized any="wiki">
                    <pages:folderEdit />
                </login:authorized>
            </router:file>
        </router:directory>
        
        <!-- Page routes -->
        <router:directory path="\cepage:url">
            <var:declare name="pageUrl" value="cepage:url" />
            <router:file name="edit" path="edit">
                <login:authorized any="wiki">
                    <pages:edit url="var:pageUrl" />
                </login:authorized>
            </router:file>
            <router:directory path="history">
                <router:file name="historyRevision" path="\cehistory:created_date">
                    <pages:historyRevision url="var:pageUrl" createdDate="cehistory:created_date" />
                </router:file>
                <router:file name="history" path="">
                    <pages:history url="var:pageUrl" />
                </router:file>
            </router:directory>
            <router:file path="" name="page">
                <pages:detail url="var:pageUrl" />
            </router:file>
        </router:directory>

        <router:directory path="\cefolder:url">
            <var:declare name="folderUrl" value="cefolder:url" />
            <router:file name="folderEdit" path="edit">
                <login:authorized any="wiki">
                    <pages:folderEdit url="var:folderUrl" />
                </login:authorized>
            </router:file>
            <router:file path="" name="folder">
                <pages:folderDetail url="var:folderUrl" />
            </router:file>

            <filter:declare name="pageWithFolder">
                <filter:exists from="ce_folder" alias="p" outerColumn="folder_id" innerColumn="id">
                    <filter:equals name="url" value="cefolder:url" />
                </filter:exists>
            </filter:declare>
            <cepage:urlResolver propertyName="url" columnName="url" filter="filter:pageWithFolder" />
            
            <!-- Page routes (with folder) -->
            <router:directory path="\cepage:url">
                <var:declare name="pageUrl" value="cepage:url" />
                <router:file name="editWithFolder" path="edit">
                    <login:authorized any="wiki">
                        <pages:edit url="var:pageUrl" />
                    </login:authorized>
                </router:file>
                <router:directory path="history">
                    <router:file name="historyRevisionWithFolder" path="\cehistory:created_date">
                        <pages:historyRevision url="var:pageUrl" createdDate="cehistory:created_date" />
                    </router:file>
                    <router:file name="historyWithFolder" path="">
                        <pages:history url="var:pageUrl" />
                    </router:file>
                </router:directory>
                <router:file path="" name="pageWithFolder">
                    <pages:detail url="var:pageUrl" />
                </router:file>
            </router:directory>
        </router:directory>
    </router:fromPath>

    <controls:auth />

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
</module:use>