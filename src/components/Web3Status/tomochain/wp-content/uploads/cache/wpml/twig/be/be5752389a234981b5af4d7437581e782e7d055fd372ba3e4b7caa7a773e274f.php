<?php

namespace WPML\Core;

use \WPML\Core\Twig\Environment;
use \WPML\Core\Twig\Error\LoaderError;
use \WPML\Core\Twig\Error\RuntimeError;
use \WPML\Core\Twig\Markup;
use \WPML\Core\Twig\Sandbox\SecurityError;
use \WPML\Core\Twig\Sandbox\SecurityNotAllowedTagError;
use \WPML\Core\Twig\Sandbox\SecurityNotAllowedFilterError;
use \WPML\Core\Twig\Sandbox\SecurityNotAllowedFunctionError;
use \WPML\Core\Twig\Source;
use \WPML\Core\Twig\Template;

/* section-menus.twig */
class __TwigTemplate_e1aa60697bb020c05c40996213942afc9ab75e102da0e8f9dedf93dbe7dfcc76 extends \WPML\Core\Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        $context["slug_placeholder"] = "%id%";
        // line 2
        echo "
";
        // line 3
        $this->loadTemplate("table-slots.twig", "section-menus.twig", 3)->display(twig_array_merge($context, ["slot_type" => "menus", "slots_settings" => $this->getAttribute(        // line 6
($context["settings"] ?? null), "menus", []), "slots" => $this->getAttribute(        // line 7
($context["data"] ?? null), "menus", [])]));
        // line 10
        echo "
";
        // line 11
        $this->loadTemplate("button-add-new-ls.twig", "section-menus.twig", 11)->display(twig_array_merge($context, ["existing_items" => \WPML\Core\twig_length_filter($this->env, $this->getAttribute(        // line 13
($context["data"] ?? null), "menus", [])), "settings_items" => \WPML\Core\twig_length_filter($this->env, $this->getAttribute(        // line 14
($context["settings"] ?? null), "menus", [])), "tooltip_all_assigned" => $this->getAttribute($this->getAttribute(        // line 15
($context["strings"] ?? null), "tooltips", []), "add_menu_all_assigned", []), "tooltip_no_item" => $this->getAttribute($this->getAttribute(        // line 16
($context["strings"] ?? null), "tooltips", []), "add_menu_no_menu", []), "button_target" => "#wpml-ls-new-menus-template", "button_label" => $this->getAttribute($this->getAttribute(        // line 18
($context["strings"] ?? null), "menus", []), "add_button_label", [])]));
        // line 21
        echo "
<script type=\"text/html\" id=\"wpml-ls-new-menus-template\" class=\"js-wpml-ls-template\">
    <div class=\"js-wpml-ls-subform wpml-ls-subform\" data-title=\"";
        // line 23
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "menus", []), "dialog_title_new", []), "html", null, true);
        echo "\" data-item-slug=\"";
        echo \WPML\Core\twig_escape_filter($this->env, ($context["slug_placeholder"] ?? null), "html", null, true);
        echo "\" data-item-type=\"menus\">

        ";
        // line 25
        $this->loadTemplate("slot-subform-menus.twig", "section-menus.twig", 25)->display(twig_array_merge($context, ["slug" =>         // line 27
($context["slug_placeholder"] ?? null), "slots_settings" =>         // line 28
($context["slots_settings"] ?? null), "slots" => $this->getAttribute(        // line 29
($context["data"] ?? null), "menus", []), "preview" => $this->getAttribute($this->getAttribute(        // line 30
($context["previews"] ?? null), "menu", []), ($context["slug"] ?? null), [], "array")]));
        // line 33
        echo "    </div>
</script>

<script type=\"text/html\" id=\"wpml-ls-new-menus-row-template\" class=\"js-wpml-ls-template\">
    ";
        // line 37
        $this->loadTemplate("table-slot-row.twig", "section-menus.twig", 37)->display(twig_array_merge($context, ["slug" =>         // line 39
($context["slug_placeholder"] ?? null), "slots" =>         // line 40
($context["menus"] ?? null)]));
        // line 43
        echo "</script>";
    }

    public function getTemplateName()
    {
        return "section-menus.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 43,  76 => 40,  75 => 39,  74 => 37,  68 => 33,  66 => 30,  65 => 29,  64 => 28,  63 => 27,  62 => 25,  55 => 23,  51 => 21,  49 => 18,  48 => 16,  47 => 15,  46 => 14,  45 => 13,  44 => 11,  41 => 10,  39 => 7,  38 => 6,  37 => 3,  34 => 2,  32 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "section-menus.twig", "/var/www/new/wp-content/plugins/sitepress-multilingual-cms/templates/language-switcher-admin-ui/section-menus.twig");
    }
}
