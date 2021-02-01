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

/* slot-subform-menus.twig */
class __TwigTemplate_8f7c6af85ad1e973f5bb739ed71a69fe7f22fb34eeffba9d2d3eee9d75c498c5 extends \WPML\Core\Twig\Template
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
        if ( !(isset($context["slot_settings"]) || array_key_exists("slot_settings", $context))) {
            // line 2
            echo "\t";
            $context["slot_settings"] = ($context["default_menus_slot"] ?? null);
        }
        // line 4
        echo "
";
        // line 5
        $this->loadTemplate("preview.twig", "slot-subform-menus.twig", 5)->display(twig_array_merge($context, ["preview" => ($context["preview"] ?? null)]));
        // line 6
        echo "
<div class=\"wpml-ls-subform-options\">

    ";
        // line 9
        $this->loadTemplate("dropdown-menus.twig", "slot-subform-menus.twig", 9)->display(twig_array_merge($context, ["slug" =>         // line 11
($context["slug"] ?? null), "menus" =>         // line 12
($context["slots"] ?? null)]));
        // line 15
        echo "
    ";
        // line 16
        $this->loadTemplate("dropdown-templates.twig", "slot-subform-menus.twig", 16)->display(twig_array_merge($context, ["id" => ("in-menus-" .         // line 18
($context["slug"] ?? null)), "name" => (("menus[" .         // line 19
($context["slug"] ?? null)) . "][template]"), "value" => $this->getAttribute(        // line 20
($context["slot_settings"] ?? null), "template", []), "slot_type" => "menus"]));
        // line 24
        echo "
    ";
        // line 25
        $this->loadTemplate("radio-position-menu.twig", "slot-subform-menus.twig", 25)->display(twig_array_merge($context, ["name_base" => (("menus[" .         // line 27
($context["slug"] ?? null)) . "]"), "slot_settings" =>         // line 28
($context["slot_settings"] ?? null)]));
        // line 31
        echo "
    ";
        // line 32
        $this->loadTemplate("radio-hierarchical-menu.twig", "slot-subform-menus.twig", 32)->display(twig_array_merge($context, ["name_base" => (("menus[" .         // line 34
($context["slug"] ?? null)) . "]"), "slot_settings" =>         // line 35
($context["slot_settings"] ?? null)]));
        // line 38
        echo "

    ";
        // line 40
        $this->loadTemplate("checkboxes-includes.twig", "slot-subform-menus.twig", 40)->display(twig_array_merge($context, ["name_base" => (("menus[" .         // line 42
($context["slug"] ?? null)) . "]"), "slot_settings" =>         // line 43
($context["slot_settings"] ?? null), "template_slug" => $this->getAttribute(        // line 44
($context["slot_settings"] ?? null), "template", [])]));
        // line 47
        echo "
    ";
        // line 48
        $this->loadTemplate("panel-colors.twig", "slot-subform-menus.twig", 48)->display(twig_array_merge($context, ["id" => ("in-menus-" .         // line 50
($context["slug"] ?? null)), "name_base" => (("menus[" .         // line 51
($context["slug"] ?? null)) . "]"), "slot_settings" =>         // line 52
($context["slot_settings"] ?? null), "slot_type" => "menus"]));
        // line 56
        echo "
</div>";
    }

    public function getTemplateName()
    {
        return "slot-subform-menus.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  91 => 56,  89 => 52,  88 => 51,  87 => 50,  86 => 48,  83 => 47,  81 => 44,  80 => 43,  79 => 42,  78 => 40,  74 => 38,  72 => 35,  71 => 34,  70 => 32,  67 => 31,  65 => 28,  64 => 27,  63 => 25,  60 => 24,  58 => 20,  57 => 19,  56 => 18,  55 => 16,  52 => 15,  50 => 12,  49 => 11,  48 => 9,  43 => 6,  41 => 5,  38 => 4,  34 => 2,  32 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "slot-subform-menus.twig", "/var/www/new/wp-content/plugins/sitepress-multilingual-cms/templates/language-switcher-admin-ui/slot-subform-menus.twig");
    }
}
