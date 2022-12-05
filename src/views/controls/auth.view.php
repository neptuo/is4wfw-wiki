<login:refresh group="wiki">
    <web:condition when="web:currentPath" is="/login" isInverted="true">
        <web:out if:true="router:hasMatch">
            <var:declare name="lastPage" value="web:currentPath" scope="session" />
        </web:out>
    </web:condition>
</login:refresh>
<web:condition when="post:logout" is="logout">
    <login:logout group="wiki">
        <var:declare name="lastPage" value="web:currentPath" scope="session" />
        <web:redirectTo pageId="route:login" />
    </login:logout>
</web:condition>