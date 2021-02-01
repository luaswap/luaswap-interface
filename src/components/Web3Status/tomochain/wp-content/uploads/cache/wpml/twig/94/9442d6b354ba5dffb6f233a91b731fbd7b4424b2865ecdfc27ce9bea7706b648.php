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

/* panel-colors.twig */
class __TwigTemplate_ffb06486ba2186ec69e5b924b36c762a6525f1e4157ca37565d0826df9234327 extends \WPML\Core\Twig\Template
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
        $context["wrapper_options"] = [0 => ["label" => $this->getAttribute($this->getAttribute(        // line 2
($context["strings"] ?? null), "color_picker", []), "background", []), "name" => "background", "schemes" => [0 => "normal"], "default" => ""], 1 => ["label" => $this->getAttribute($this->getAttribute(        // line 3
($context["strings"] ?? null), "color_picker", []), "border", []), "name" => "border", "schemes" => [0 => "normal"], "default" => ""]];
        // line 6
        echo "
";
        // line 7
        $context["options"] = [0 => ["label" => $this->getAttribute($this->getAttribute(        // line 8
($context["strings"] ?? null), "color_picker", []), "font_current", []), "name" => "font_current", "schemes" => [0 => "normal", 1 => "hover"], "default" => ""], 1 => ["label" => $this->getAttribute($this->getAttribute(        // line 9
($context["strings"] ?? null), "color_picker", []), "background_current", []), "name" => "background_current", "schemes" => [0 => "normal", 1 => "hover"], "default" => ""], 2 => ["label" => $this->getAttribute($this->getAttribute(        // line 10
($context["strings"] ?? null), "color_picker", []), "font_other", []), "name" => "font_other", "schemes" => [0 => "normal", 1 => "hover"], "default" => ""], 3 => ["label" => $this->getAttribute($this->getAttribute(        // line 11
($context["strings"] ?? null), "color_picker", []), "background_other", []), "name" => "background_other", "schemes" => [0 => "normal", 1 => "hover"], "default" => ""]];
        // line 14
        echo "
";
        // line 15
        if ((($context["slot_type"] ?? null) != "menus")) {
            // line 16
            echo "    ";
            $context["options"] = \WPML\Core\twig_array_merge(($context["wrapper_options"] ?? null), ($context["options"] ?? null));
        }
        // line 18
        echo "
";
        // line 19
        $context["css_class"] = (((isset($context["css_class"]) || array_key_exists("css_class", $context))) ? (\WPML\Core\_twig_default_filter(($context["css_class"] ?? null), "js-wpml-ls-colorpicker")) : ("js-wpml-ls-colorpicker"));
        // line 20
        echo "
<div class=\"js-wpml-ls-panel-colors wpml-ls-panel-colors\">
    <h4>";
        // line 22
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "color_picker", []), "panel_title", []), "html", null, true);
        echo "</h4>

    <label for=\"wpml-ls-";
        // line 24
        echo \WPML\Core\twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
        echo "-colorpicker-preset\">";
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "color_picker", []), "label_color_preset", []), "html", null, true);
        echo "</label>
    <select name=\"wpml-ls-";
        // line 25
        echo \WPML\Core\twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
        echo "-colorpicker-preset\" class=\"js-wpml-ls-colorpicker-preset\">
        <option value=\"\">-- ";
        // line 26
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "color_picker", []), "select_option_choose", []), "html", null, true);
        echo " --</option>
        ";
        // line 27
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["color_schemes"] ?? null));
        foreach ($context['_seq'] as $context["scheme_id"] => $context["scheme"]) {
            // line 28
            echo "            <option value=\"";
            echo \WPML\Core\twig_escape_filter($this->env, $context["scheme_id"], "html", null, true);
            echo "\">";
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["scheme"], "label", []), "html", null, true);
            echo "</option>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['scheme_id'], $context['scheme'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 30
        echo "    </select>

    <div>
        <table>
            <tr>
                <td>
                </td>
                <th>";
        // line 37
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "color_picker", []), "label_normal_scheme", []), "html", null, true);
        echo "</th>
                <th>";
        // line 38
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "color_picker", []), "label_hover_scheme", []), "html", null, true);
        echo "</th>
            </tr>
            ";
        // line 40
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["options"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
            // line 41
            echo "            <tr>
                <td>";
            // line 42
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["option"], "label", []), "html", null, true);
            echo "</td>
                <td class=\"js-wpml-ls-colorpicker-wrapper\">
                    ";
            // line 44
            if (twig_in_filter("normal", $this->getAttribute($context["option"], "schemes", []))) {
                // line 45
                echo "                        ";
                if (($context["name_base"] ?? null)) {
                    // line 46
                    echo "                            ";
                    $context["input_name"] = (((($context["name_base"] ?? null) . "[") . $this->getAttribute($context["option"], "name", [])) . "_normal]");
                    // line 47
                    echo "                        ";
                } else {
                    // line 48
                    echo "                            ";
                    $context["input_name"] = ($this->getAttribute($context["option"], "name", []) . "_normal");
                    // line 49
                    echo "                        ";
                }
                // line 50
                echo "                        <input class=\"";
                echo \WPML\Core\twig_escape_filter($this->env, ($context["css_class"] ?? null), "html", null, true);
                echo " js-wpml-ls-color-";
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["option"], "name", []), "html", null, true);
                echo "_normal\" type=\"text\" size=\"7\"
                               id=\"wpml-ls-";
                // line 51
                echo \WPML\Core\twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
                echo "-";
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["option"], "name", []), "html", null, true);
                echo "-normal\" name=\"";
                echo \WPML\Core\twig_escape_filter($this->env, ($context["input_name"] ?? null), "html", null, true);
                echo "\"
                               value=\"";
                // line 52
                echo \WPML\Core\twig_escape_filter($this->env, (($this->getAttribute(($context["slot_settings"] ?? null), ($this->getAttribute($context["option"], "name", []) . "_normal"), [], "array", true, true)) ? (\WPML\Core\_twig_default_filter($this->getAttribute(($context["slot_settings"] ?? null), ($this->getAttribute($context["option"], "name", []) . "_normal"), [], "array"), $this->getAttribute($context["option"], "default", []))) : ($this->getAttribute($context["option"], "default", []))), "html", null, true);
                echo "\" data-default-color=\"";
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["option"], "default", []), "html", null, true);
                echo "\" style=\"display: none;\">
                    ";
            }
            // line 54
            echo "                </td>
                <td class=\"js-wpml-ls-colorpicker-wrapper\">
                    ";
            // line 56
            if (twig_in_filter("hover", $this->getAttribute($context["option"], "schemes", []))) {
                // line 57
                echo "                        ";
                if (($context["name_base"] ?? null)) {
                    // line 58
                    echo "                            ";
                    $context["input_name"] = (((($context["name_base"] ?? null) . "[") . $this->getAttribute($context["option"], "name", [])) . "_hover]");
                    // line 59
                    echo "                        ";
                } else {
                    // line 60
                    echo "                            ";
                    $context["input_name"] = ($this->getAttribute($context["option"], "name", []) . "_hover");
                    // line 61
                    echo "                        ";
                }
                // line 62
                echo "                        <input class=\"";
                echo \WPML\Core\twig_escape_filter($this->env, ($context["css_class"] ?? null), "html", null, true);
                echo " js-wpml-ls-color-";
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["option"], "name", []), "html", null, true);
                echo "_hover\" type=\"text\" size=\"7\"
                               id=\"wpml-ls-";
                // line 63
                echo \WPML\Core\twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
                echo "-";
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["option"], "name", []), "html", null, true);
                echo "-hover\" name=\"";
                echo \WPML\Core\twig_escape_filter($this->env, ($context["input_name"] ?? null), "html", null, true);
                echo "\"
                               value=\"";
                // line 64
                echo \WPML\Core\twig_escape_filter($this->env, (($this->getAttribute(($context["slot_settings"] ?? null), ($this->getAttribute($context["option"], "name", []) . "_hover"), [], "array", true, true)) ? (\WPML\Core\_twig_default_filter($this->getAttribute(($context["slot_settings"] ?? null), ($this->getAttribute($context["option"], "name", []) . "_hover"), [], "array"), $this->getAttribute($context["option"], "default", []))) : ($this->getAttribute($context["option"], "default", []))), "html", null, true);
                echo "\" data-default-color=\"";
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["option"], "default", []), "html", null, true);
                echo "\" style=\"display: none;\">
                    ";
            }
            // line 66
            echo "                </td>
            </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 69
        echo "        </table>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "panel-colors.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  217 => 69,  209 => 66,  202 => 64,  194 => 63,  187 => 62,  184 => 61,  181 => 60,  178 => 59,  175 => 58,  172 => 57,  170 => 56,  166 => 54,  159 => 52,  151 => 51,  144 => 50,  141 => 49,  138 => 48,  135 => 47,  132 => 46,  129 => 45,  127 => 44,  122 => 42,  119 => 41,  115 => 40,  110 => 38,  106 => 37,  97 => 30,  86 => 28,  82 => 27,  78 => 26,  74 => 25,  68 => 24,  63 => 22,  59 => 20,  57 => 19,  54 => 18,  50 => 16,  48 => 15,  45 => 14,  43 => 11,  42 => 10,  41 => 9,  40 => 8,  39 => 7,  36 => 6,  34 => 3,  33 => 2,  32 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "panel-colors.twig", "/var/www/new/wp-content/plugins/sitepress-multilingual-cms/templates/language-switcher-admin-ui/panel-colors.twig");
    }
}
