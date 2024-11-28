import { useState } from "react";
import { useNavigate } from "react-router-dom";
import { Button } from "@/components/ui/button";
import { Card } from "@/components/ui/card";
import { Car, LogOut } from "lucide-react";
import ParkingSlots from "@/components/ParkingSlots";

const Dashboard = () => {
  const navigate = useNavigate();
  const [selectedCategory, setSelectedCategory] = useState<"sticker" | "no-sticker" | null>(null);

  return (
    <div className="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50 p-4">
      <div className="max-w-7xl mx-auto space-y-6">
        <div className="flex justify-between items-center">
          <h1 className="text-3xl font-bold">Dashboard</h1>
          <Button
            variant="ghost"
            onClick={() => navigate("/")}
            className="flex items-center gap-2"
          >
            <LogOut className="w-4 h-4" />
            Logout
          </Button>
        </div>

        <div className="grid md:grid-cols-2 gap-4 fade-in">
          <Card
            className={`p-6 cursor-pointer glass-panel button-hover ${
              selectedCategory === "sticker" ? "ring-2 ring-primary" : ""
            }`}
            onClick={() => setSelectedCategory("sticker")}
          >
            <div className="flex items-center gap-4">
              <Car className="w-8 h-8 text-primary" />
              <div>
                <h2 className="text-xl font-semibold">With Sticker</h2>
                <p className="text-sm text-muted-foreground">Manage vehicles with parking stickers</p>
              </div>
            </div>
          </Card>

          <Card
            className={`p-6 cursor-pointer glass-panel button-hover ${
              selectedCategory === "no-sticker" ? "ring-2 ring-primary" : ""
            }`}
            onClick={() => setSelectedCategory("no-sticker")}
          >
            <div className="flex items-center gap-4">
              <Car className="w-8 h-8 text-primary" />
              <div>
                <h2 className="text-xl font-semibold">Without Sticker</h2>
                <p className="text-sm text-muted-foreground">Manage visitor vehicles</p>
              </div>
            </div>
          </Card>
        </div>

        {selectedCategory && <ParkingSlots category={selectedCategory} />}
      </div>
    </div>
  );
};

export default Dashboard;