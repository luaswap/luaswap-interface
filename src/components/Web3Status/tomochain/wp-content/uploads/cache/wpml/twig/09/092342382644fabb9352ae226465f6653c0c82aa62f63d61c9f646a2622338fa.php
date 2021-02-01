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

/* table-slot-row.twig */
class __TwigTemplate_cbc53d5f995675c85fa700e95ae9dbbf01afdf7f82fc7faef4cf2e1bbb52ca45 extends \WPML\Core\Twig\Template
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
        if ((($context["slot_type"] ?? null) == "statics")) {
            // line 2
            echo "\t";
            $context["is_static"] = true;
            // line 3
            echo "\t";
            $context["dialog_title"] = $this->getAttribute($this->getAttribute(($context["strings"] ?? null), ($context["slug"] ?? null), [], "array"), "dialog_title", []);
            // line 4
            echo "\t";
            $context["include_row"] = (((("slot-subform-" . ($context["slot_type"] ?? null)) . "-") . ($context["slug"] ?? null)) . ".twig");
        } else {
            // line 6
            echo "\t";
            $context["dialog_title"] = $this->getAttribute($this->getAttribute(($context["strings"] ?? null), ($context["slot_type"] ?? null), [], "array"), "dialog_title", []);
            // line 7
            echo "\t";
            $context["include_row"] = (("slot-subform-" . ($context["slot_type"] ?? null)) . ".twig");
        }
        // line 9
        echo "
";
        // line 10
        $context["slot_row_id"] = ((("wpml-ls-" . ($context["slot_type"] ?? null)) . "-row-") . ($context["slug"] ?? null));
        // line 11
        echo "<tr id=\"";
        echo \WPML\Core\twig_escape_filter($this->env, ($context["slot_row_id"] ?? null), "html", null, true);
        echo "\" class=\"js-wpml-ls-row\" data-item-slug=\"";
        echo \WPML\Core\twig_escape_filter($this->env, ($context["slug"] ?? null), "html", null, true);
        echo "\" data-item-type=\"";
        echo \WPML\Core\twig_escape_filter($this->env, ($context["slot_type"] ?? null), "html", null, true);
        echo "\">
    <td class=\"wpml-ls-cell-preview\">
        <div class=\"js-wpml-ls-subform wpml-ls-subform\" data-origin-id=\"";
        // line 13
        echo \WPML\Core\twig_escape_filter($this->env, ($context["slot_row_id"] ?? null), "html", null, true);
        echo "\" data-title=\"";
        echo \WPML\Core\twig_escape_filter($this->env, ($context["dialog_title"] ?? null), "html", null, true);
        echo "\" data-item-slug=\"";
        echo \WPML\Core\twig_escape_filter($this->env, ($context["slug"] ?? null), "html", null, true);
        echo "\" data-item-type=\"";
        echo \WPML\Core\twig_escape_filter($this->env, ($context["slot_type"] ?? null), "html", null, true);
        echo "\">
            ";
        // line 14
        if (($context["slot_settings"] ?? null)) {
            // line 15
            echo "                ";
            $this->loadTemplate(($context["include_row"] ?? null), "table-slot-row.twig", 15)->display(twig_array_merge($context, ["slug" =>             // line 17
($context["slug"] ?? null), "slot_settings" =>             // line 18
($context["slot_settings"] ?? null), "settings" =>             // line 19
($context["settings"] ?? null), "slots" =>             // line 20
($context["slots"] ?? null), "strings" =>             // line 21
($context["strings"] ?? null), "preview" => $this->getAttribute($this->getAttribute(            // line 22
($context["previews"] ?? null), ($context["slot_type"] ?? null), [], "array"), ($context["slug"] ?? null), [], "array"), "color_schemes" =>             // line 23
($context["color_schemes"] ?? null)]));
            // line 26
            echo "            ";
        }
        // line 27
        echo "        </div>
    </td>

\t";
        // line 30
        if ( !($context["is_static"] ?? null)) {
            // line 31
            echo "    <td>
        <span class=\"js-wpml-ls-row-title\">";
            // line 32
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["slots"] ?? null), ($context["slug"] ?? null), [], "array"), "name", []), "html", null, true);
            echo "</span>
    </td>
\t";
        }
        // line 35
        echo "
\t<td class=\"wpml-ls-cell-action\">
        <a href=\"#\" title=\"";
        // line 37
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "misc", []), "title_action_edit", []), "html", null, true);
        echo "\" class=\"js-wpml-ls-row-edit wpml-ls-row-edit\"><i class=\"otgs-ico-edit\"></i></a>
    </td>

\t";
        // line 40
        if ( !($context["is_static"] ?? null)) {
            // line 41
            echo "    <td class=\"wpml-ls-cell-action\">
        <a href=\"#\" title=\"";
            // line 42
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "misc", []), "title_action_delete", []), "html", null, true);
            echo "\" class=\"js-wpml-ls-row-remove wpml-ls-row-remove\"><i class=\"otgs-ico-delete\"></i></a>
    </td>
\t";
        }
        // line 45
        echo "</tr>";
    }

    public function getTemplateName()
    {
        return "table-slot-row.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  128 => 45,  122 => 42,  119 => 41,  117 => 40,  111 => 37,  107 => 35,  101 => 32,  98 => 31,  96 => 30,  91 => 27,  88 => 26,  86 => 23,  85 => 22,  84 => 21,  83 => 20,  82 => 19,  81 => 18,  80 => 17,  78 => 15,  76 => 14,  66 => 13,  56 => 11,  54 => 10,  51 => 9,  47 => 7,  44 => 6,  40 => 4,  37 => 3,  34 => 2,  32 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "table-slot-row.twig", "/var/www/new/wp-content/plugins/sitepress-multilingual-cms/templates/language-switcher-admin-ui/table-slot-row.twig");
    }
}
