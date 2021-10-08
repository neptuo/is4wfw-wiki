<login:init group="wiki" cookieName="wiki" />
<login:refresh group="wiki" />
<web:condition when="post:logout" is="logout">
    <login:logout group="wiki">
        <var:declare name="lastPage" value="web:currentPath" scope="session" />
        <web:redirectTo pageId="route:login" />
    </login:logout>
</web:condition>