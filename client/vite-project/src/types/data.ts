export interface Destination {
  id: number;
  srcm: string;
  srct: string;
  srcd: string;
  alt: string;
  title: string;
  content: string;
  km: string;
  days: string;
}

export interface CrewMember {
  id: number;
  srcm: string;
  srct: string;
  srcd: string;
  alt: string;
  subtitle: string;
  title: string;
  content: string;
}

export interface Technology {
  id: number;
  srcm: string;
  srct: string;
  srcd: string;
  alt: string;
  subtitle: string;
  title: string;
  content: string;
}

export interface SpaceData {
  destinationData: Destination[];
  crewData: CrewMember[];
  technologyData: Technology[];
}

export function isSpaceData(data: unknown): data is SpaceData {
  const spaceData = data as SpaceData;
  return (
    !!spaceData &&
    Array.isArray(spaceData.destinationData) &&
    Array.isArray(spaceData.crewData) &&
    Array.isArray(spaceData.technologyData)
  );
}
