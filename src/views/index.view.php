<module:use id="var:moduleId">
    <php:lazy cepage="php.libs.CustomEntity" />
    <php:attribute prefix="cepage" tag="*" name="name" value="page" />
    <php:lazy cehistory="php.libs.CustomEntity" />
    <php:attribute prefix="cehistory" tag="*" name="name" value="pagehistory" />
    <php:lazy cefolder="php.libs.CustomEntity" />
    <php:attribute prefix="cefolder" tag="*" name="name" value="folder" />

    <var:declare name="ajax" value="php:false" />
    <var:use name="favorites" scope="user" />

    <login:init group="wiki" />

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
                <filter:in name="id" values="var:favorites" if:stringEmpty="var:favorites" if:not="true" />
                <filter:in name="id" values="-" if:stringEmpty="var:favorites" />
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
        
        <web:lookless><!-- Page routes --></web:lookless>
        <router:directory path="\cepage:url">
            <var:declare name="pageUrl" value="cepage:url" />
            <router:file name="edit" path="edit">
                <login:authorized any="wiki">
                    <pages:edit url="var:pageUrl" />
                </login:authorized>
            </router:file>
            <router:directory path="ajax">
                <web:out if:true="router:isEvaluate">
                    <var:declare name="ajax" value="php:true" />
                </web:out>
                <router:file path="upload">
                    <pages:ajaxUpload />
                </router:file>
            </router:directory>
            <router:directory path="history">
                <router:file name="historyRevision" path="\cehistory:created_date">
                    <pages:historyRevision url="var:pageUrl" createdDate="cehistory:created_date" />
                </router:file>
                <router:file name="history" path="">
                    <pages:history url="var:pageUrl" />
                </router:file>
            </router:directory>
            <router:file path="files" name="files">
                <pages:files url="var:pageUrl" />
            </router:file>
            <router:file path="delete" name="delete">
                <pages:delete url="var:pageUrl" />
            </router:file>
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
            
            <web:lookless><!-- Page routes (with folder) --></web:lookless>
            <router:directory path="\cepage:url">
                <var:declare name="pageUrl" value="cepage:url" />
                <router:file name="editWithFolder" path="edit">
                    <login:authorized any="wiki">
                        <pages:edit url="var:pageUrl" />
                    </login:authorized>
                </router:file>
                <router:directory path="ajax">
                    <web:out if:true="router:isEvaluate">
                        <var:declare name="ajax" value="php:true" />
                    </web:out>
                    <router:file path="upload">
                        <pages:ajaxUpload />
                    </router:file>
                </router:directory>
                <router:directory path="history">
                    <router:file name="historyRevisionWithFolder" path="\cehistory:created_date">
                        <pages:historyRevision url="var:pageUrl" createdDate="cehistory:created_date" />
                    </router:file>
                    <router:file name="historyWithFolder" path="">
                        <pages:history url="var:pageUrl" />
                    </router:file>
                </router:directory>
                <router:file path="files" name="filesWithFolder">
                    <pages:files url="var:pageUrl" />
                </router:file>
                <router:file path="delete" name="deleteWithFolder">
                    <pages:delete url="var:pageUrl" />
                </router:file>
                <router:file path="" name="pageWithFolder">
                    <pages:detail url="var:pageUrl" />
                </router:file>
            </router:directory>
        </router:directory>
    </router:fromPath>

    <controls:template />
</module:use>