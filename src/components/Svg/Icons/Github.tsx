import React from "react";
import Svg from "../../../components/Svg/Svg";
import { SvgProps } from "../../../components/Svg/types";

const Icon: React.FC<SvgProps> = (props) => {
  return (
    <Svg viewBox="0 0 24 24" {...props}>
      <path d="m12.29 21.499c3.73 0 8.94.09 10.835-3.701.715-1.449.875-3.122.875-4.7h-.001c0-2.073-.575-4.047-1.95-5.651.786-2.363.26-3.756-.345-4.948-2.24 0-3.69.42-5.39 1.742-2.746-.653-5.856-.571-8.455.04-1.725-1.336-3.175-1.781-5.44-1.781-.621 1.237-1.136 2.599-.344 4.977-2.676 3.083-2.466 7.566-1.065 10.322 1.97 3.835 7.49 3.7 11.28 3.7zm-5.289-9.99c.95 0 1.865.168 2.8.297 3.418.52 5.215-.297 7.31-.297 2.339 0 3.675 1.915 3.675 4.087 0 4.349-4.015 5.012-7.53 5.012-2.419-.163-9.93.976-9.93-5.012 0-2.172 1.334-4.087 3.675-4.087z"/>
          <path d="m16.655 18.323c1.29 0 1.835-1.692 1.835-2.727s-.545-2.727-1.835-2.727-1.835 1.692-1.835 2.727.545 2.727 1.835 2.727z"/>
          <path d="m7.47 18.323c1.29 0 1.835-1.692 1.835-2.727s-.546-2.726-1.835-2.726-1.835 1.692-1.835 2.727.545 2.726 1.835 2.726z"/>
      </Svg>

  );
};

export default Icon;
