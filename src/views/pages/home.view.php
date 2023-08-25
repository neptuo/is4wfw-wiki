<filter:declare name="homePage" alias="p">
    <filter:equals name="url" value="home" />
    <login:authorized none="wiki">
        <filter:equals name="is_public" value="1" />
    </login:authorized>
</filter:declare>
<cepage:list filter="filter:homePage">
    <ui:first items="cepage:list">
        <pages:detail url="cepage:url" />
    </ui:first>
    <ui:empty items="cepage:list">
        <controls:pageListGrouped>
            <filter:or>
                <filter:null name="is_archived" />
                <filter:equals name="is_archived" value="0" />
            </filter:or>
        </controls:pageListGrouped>
    </ui:empty>
</cepage:list>
