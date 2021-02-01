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

/* section-sidebars.twig */
class __TwigTemplate_a82ef63694c4b7982c68eef2ae33e84fe68aad0348e65c0a2e759331180de9ce extends \WPML\Core\Twig\Template
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
        $this->loadTemplate("table-slots.twig", "section-sidebars.twig", 3)->display(twig_array_merge($context, ["slot_type" => "sidebars", "slots_settings" => $this->getAttribute(        // line 6
($context["settings"] ?? null), "sidebars", []), "slots" => $this->getAttribute(        // line 7
($context["data"] ?? null), "sidebars", [])]));
        // line 10
        echo "
";
        // line 11
        $this->loadTemplate("button-add-new-ls.twig", "section-sidebars.twig", 11)->display(twig_array_merge($context, ["existing_items" => \WPML\Core\twig_length_filter($this->env, $this->getAttribute(        // line 13
($context["data"] ?? null), "sidebars", [])), "settings_items" => \WPML\Core\twig_length_filter($this->env, $this->getAttribute(        // line 14
($context["settings"] ?? null), "sidebars", [])), "tooltip_all_assigned" => $this->getAttribute($this->getAttribute(        // line 15
($context["strings"] ?? null), "tooltips", []), "add_sidebar_all_assigned", []), "tooltip_no_item" => $this->getAttribute($this->getAttribute(        // line 16
($context["strings"] ?? null), "tooltips", []), "add_sidebar_no_sidebar", []), "button_target" => "#wpml-ls-new-sidebars-template", "button_label" => $this->getAttribute($this->getAttribute(        // line 18
($context["strings"] ?? null), "sidebars", []), "add_button_label", [])]));
        // line 21
        echo "
<script type=\"text/html\" id=\"wpml-ls-new-sidebars-template\" class=\"js-wpml-ls-template\">
    <div class=\"js-wpml-ls-subform wpml-ls-subform\" data-title=\"";
        // line 23
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "sidebars", []), "dialog_title_new", []), "html", null, true);
        echo "\" data-item-slug=\"";
        echo \WPML\Core\twig_escape_filter($this->env, ($context["slug_placeholder"] ?? null), "html", null, true);
        echo "\" data-item-type=\"sidebars\">

        ";
        // line 25
        $this->loadTemplate("slot-subform-sidebars.twig", "section-sidebars.twig", 25)->display(twig_array_merge($context, ["slug" =>         // line 27
($context["slug_placeholder"] ?? null), "slots_settings" =>         // line 28
($context["slots_settings"] ?? null), "slots" => $this->getAttribute(        // line 29
($context["data"] ?? null), "sidebars", []), "preview" => $this->getAttribute($this->getAttribute(        // line 30
($context["previews"] ?? null), "sidebars", []), ($context["slug"] ?? null), [], "array")]));
        // line 33
        echo "
    </div>
</script>

<script type=\"text/html\" id=\"wpml-ls-new-sidebars-row-template\" class=\"js-wpml-ls-template\">
    ";
        // line 38
        $this->loadTemplate("table-slot-row.twig", "section-sidebars.twig", 38)->display(twig_array_merge($context, ["slug" =>         // line 40
($context["slug_placeholder"] ?? null), "slots" =>         // line 41
($context["sidebars"] ?? null)]));
        // line 44
        echo "</script>";
    }

    public function getTemplateName()
    {
        return "section-sidebars.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  79 => 44,  77 => 41,  76 => 40,  75 => 38,  68 => 33,  66 => 30,  65 => 29,  64 => 28,  63 => 27,  62 => 25,  55 => 23,  51 => 21,  49 => 18,  48 => 16,  47 => 15,  46 => 14,  45 => 13,  44 => 11,  41 => 10,  39 => 7,  38 => 6,  37 => 3,  34 => 2,  32 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "section-sidebars.twig", "/var/www/new/wp-content/plugins/sitepress-multilingual-cms/templates/language-switcher-admin-ui/section-sidebars.twig");
    }
}
