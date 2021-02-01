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

/* media-translation.twig */
class __TwigTemplate_ff2f45be8259ff7d19186b6ca38f4cb0575012a62818d0e2f0e7ccae158e0c3d extends \WPML\Core\Twig\Template
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
        echo "<div class=\"wrap\">

    <h2>";
        // line 3
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "heading", []), "html", null, true);
        echo "</h2>

    ";
        // line 5
        $this->loadTemplate("batch-translation.twig", "media-translation.twig", 5)->display(twig_array_merge($context, ($context["batch_translation"] ?? null)));
        // line 6
        echo "
    <div class=\"tablenav top wpml-media-tablenav\">
        ";
        // line 8
        $this->loadTemplate("media-translation-filters.twig", "media-translation.twig", 8)->display($context);
        // line 9
        echo "    </div>

    <table class=\"widefat striped wpml-media-table js-otgs-table-sticky-header\">
        <thead>
        <tr>
            <th class=\"wpml-col-media-title\">";
        // line 14
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "original_language", []), "html", null, true);
        echo "</th>
            <th class=\"wpml-col-media-translations\">
                ";
        // line 16
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["code"] => $context["language"]) {
            // line 17
            echo "                    ";
            if ((twig_test_empty(($context["target_language"] ?? null)) || (($context["target_language"] ?? null) == $context["code"]))) {
                // line 18
                echo "                        <span class=\"js-otgs-popover-tooltip\" title=\"";
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["language"], "name", []), "html", null, true);
                echo "\"><img src=\"";
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["language"], "flag", []), "html", null, true);
                echo "\"
                                                                                               width=\"16\" height=\"12\"
                                                                                               alt=\"";
                // line 20
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["language"], "code", []), "html", null, true);
                echo "\"></span>
                    ";
            }
            // line 22
            echo "                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['code'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 23
        echo "            </th>
        </tr>
        </thead>
        <tbody>
        ";
        // line 27
        if (($context["attachments"] ?? null)) {
            // line 28
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["attachments"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["attachment"]) {
                // line 29
                echo "                ";
                $this->loadTemplate("media-translation-table-row.twig", "media-translation.twig", 29)->display(twig_to_array(["attachment" => $context["attachment"], "languages" => ($context["languages"] ?? null), "strings" => ($context["strings"] ?? null), "target_language" => ($context["target_language"] ?? null)]));
                // line 30
                echo "            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['attachment'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 31
            echo "        ";
        } else {
            // line 32
            echo "            <tr>
                <td colspan=\"2\">";
            // line 33
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "no_attachments", []), "html", null, true);
            echo "</td>
            </tr>
        ";
        }
        // line 36
        echo "        </tbody>

    </table>

    <div class=\"tablenav bottom\">
        ";
        // line 41
        $this->loadTemplate("pagination.twig", "media-translation.twig", 41)->display(twig_to_array(["pagination_model" => ($context["pagination"] ?? null)]));
        // line 42
        echo "
        ";
        // line 43
        $this->loadTemplate("media-translation-popup.twig", "media-translation.twig", 43)->display($context);
        // line 44
        echo "
    </div>

</div>";
    }

    public function getTemplateName()
    {
        return "media-translation.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  135 => 44,  133 => 43,  130 => 42,  128 => 41,  121 => 36,  115 => 33,  112 => 32,  109 => 31,  103 => 30,  100 => 29,  95 => 28,  93 => 27,  87 => 23,  81 => 22,  76 => 20,  68 => 18,  65 => 17,  61 => 16,  56 => 14,  49 => 9,  47 => 8,  43 => 6,  41 => 5,  36 => 3,  32 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "media-translation.twig", "/var/www/new/wp-content/plugins/wpml-media-translation/templates/menus/media-translation.twig");
    }
}
