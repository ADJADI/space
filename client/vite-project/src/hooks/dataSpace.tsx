import { useEffect, useState } from "react";
import { Destination, CrewMember, Technology } from "../types/data";

type DataType = "destinations" | "crew" | "technology";
type DataContent = Destination[] | CrewMember[] | Technology[] | [];

export default function useDataSpace() {
  const [data, setData] = useState<DataContent>([]);
  const [type, setType] = useState<DataType>("destinations");
  const [loading, setLoading] = useState<boolean>(true);
  const [error, setError] = useState<string | null>(null);

  const changeType = (newType: DataType) => {
    if (["destinations", "crew", "technology"].includes(newType)) {
      setType(newType);
    }
  };

  useEffect(() => {
    setLoading(true);
    setError(null);

    fetch(`https://space-production-0b86.up.railway.app/api/${type}`)
      .then((response) => {
        if (!response.ok) {
          throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
      })
      .then((responseData) => {
        setData(responseData);
        setLoading(false);
      })
      .catch((error) => {
        console.error("Error fetching data:", error);
        setError(error.message);
        setLoading(false);
      });
  }, [type]);
  return {
    data,
    type,
    changeType,
    loading,
    error,
    isDestinations: type === "destinations",
    isCrew: type === "crew",
    isTechnology: type === "technology",
  };
}
