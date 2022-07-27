const get_component = (name) => require(`./components/global/${name}`).default

export const components = (app) => {
    app.component("icon", get_component("Icon"))
    app.component("input-float", get_component("InputFloat"))
    app.component("input-float-blur", get_component("InputFloatBlur"))
    app.component("checkbox", get_component("Checkbox"))
    app.component("toggle-height", get_component('ToggleHeight'))
    app.component("mb-row", get_component('Row'))
    app.component("mb-col", get_component('Col'))
    app.component("btn", get_component('MBButton'))
    app.component("select-float", get_component('SelectFloat'))
    app.component("dropdown-search", get_component('DropdownSearch'))
    app.component("multiselect-float", get_component('MultiselectFloat'))
    app.component("search-form", get_component('SearchForm'))
    app.component("toggle-label", get_component('ToggleLabel'))
   // app.component("b-table", get_component('Table'))
    app.component("textarea-float", get_component('TextareaFloat'))
    app.component("side-menu", get_component('SideMenu'))
    app.component("hamburger", get_component('Hamburger'))
    app.component("app-menu", get_component('AppMenu'))
    app.component("app-nav", get_component('AppNav'))

}